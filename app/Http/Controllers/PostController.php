<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    //  key to store all posts in redis and expiration time for the key in redis
    const POSTS_ALL = "posts.all";
    const LAST_POST = "lastpost-";
    const EXPIRATION_TIME = 60 * 60;

    //  Function to get all the posts from database
    private function getAllPosts() {
        return Post::orderBy("publication_date", "desc")->get();
    }
    //  Function to retreive the expiration time for keys in redis, get it from env or the default configured
    private function getRedisEx() {
        return env('REDIS_EX', self::EXPIRATION_TIME);
    }

    //  FUnction to update redis after a new post is created
    private function updateRedis() {
        //  Update key that have all the post to show in the main page
        Cache::put(self::POSTS_ALL, $this->getAllPosts(), $this->getRedisEx());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Retrieve the data from redis if exists, if not, retrieve from db and store in redis before return it
        $posts = Cache::remember(self::POSTS_ALL, $this->getRedisEx(), function () {
            return $this->getAllPosts();
        });

        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //	Validamos los datos que nos llegan
    	$data = request()->validate([
    		"title" => "required",
            "description" => "required|max:5000",
    	]);
        //  Add the user id who creates the post
        $data["user_id"] = Auth::user()->id;

        $post = Post::create($data);

        //  Update redis cache to have the new entry
        $this->updateRedis($post);

        //  Update the last post created
        $this->updateLastPostCached($post);

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }

    //  Show the posts of the user passed
    public function userPosts(User $user) {
        //  Retrieve user's posts and return it to the view
        $posts = $user->posts;

        return view("posts.userPosts", compact("user", "posts"));
    }

    //  Import posts from API
    public function import() {
        return view("posts.importPosts");
    }

    //  Store posts from API
    public function storeimport(Request $request) {
        $data = $request->validate([
            "url" => "required|url"
        ]);

        //  Make request and get the posts we want to import
        $response = Http::get($data["url"]);
        $posts = $response->json()["data"];
        //  To check if new post are imported
        $newPostImported = false;
        $adminUserId = User::where("name", "admin")->pluck("id")->first();

        foreach ($posts as $post) {
            //  First check if we have and identical post imported yet
            $yet = Post::where("title", $post["title"])
                ->where("description", $post["description"])
                ->where("publication_date", $post["publication_date"])
                ->first();


            if($yet === null) {
                //  Add user id
                $post["user_id"] = $adminUserId;
                Post::create($post);
                $newPostImported = true;
            }

            //  If we have new posts update redis
            if($newPostImported) {
                Cache::put(self::POSTS_ALL, $this->getAllPosts(), $this->getRedisEx());
            }
        }

        return redirect()->route("posts.index");
    }
}
