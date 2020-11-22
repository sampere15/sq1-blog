<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    //  key to store all posts in redis and expiration time for the key in redis
    const POSTS_ALL = "posts.all";
    const EXPIRATION_TIME = 60;

    //  Function to get all the posts from database
    private function getAllPosts() {
        return Post::orderBy("publication_date", "desc")->get();
    }
    //  Function to retreive the expiration time for keys in redis, get it from env or the default configured
    private function getRedisEx() {
        return env('REDIS_EX', self::EXPIRATION_TIME);
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
    		"title" => "required|max:50",
            "description" => "required|max:5000",
    	]);
        //  Add the user id who creates the post
        $data["user_id"] = Auth::user()->id;

        Post::create($data);

        //  Update redis cache to have the new entry
        Cache::put(self::POSTS_ALL, $this->getAllPosts(), $this->getRedisEx());

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
}
