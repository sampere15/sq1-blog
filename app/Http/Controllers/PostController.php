<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy("publication_date", "desc")->get();
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

        $data["user_id"] = Auth::user()->id;

        Post::create($data);

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
        //
    }

    // //  Check validation before create a post
    // private function ValidateData($input)
    // {
    //     //  Rules to check
    //     $rules = [
    //         "title" => "required|max:50",
    //         "description" => "required|max:5000",
    //     ];

    //     $validator = Validator::make($input, $rules);

    //     return $validator;
    // }
}
