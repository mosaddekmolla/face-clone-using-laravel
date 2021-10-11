<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
        
        // dd($userShow);
        // return view('layouts.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|unique:posts|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);

        if ($request->hasFile('image')) 
        {
            $file = $request->file('image');

            $imageFinal = processImage($file);
        }

        Post::insert([
            'status' =>  $request->get('status') ?? '',
            'photo' => $request->hasFile('image') ? $imageFinal : '',
            'likes' => json_encode(array()),
            'shares' => json_encode(array()),
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    public function updateLikes(Request $request){
        $postId= $request->get('post_id') ?? '';
        if($postId){
            $post= Post::find($postId);
            $likes= $post->likes;
            $likes_array= json_decode($likes, true);

            if(in_array(auth()->user()->id, $likes_array)){
                $likes_array= array_diff($likes_array, [auth()->user()->id]);
                $post->likes= json_encode($likes_array);
                $post->save();

                return json_encode([
                   'success'=> true,
                   'result'=> -1
                ]);
            } else{
                array_push($likes_array, auth()->user()->id);
                $post->likes= json_encode($likes_array);
                $post->save();

                return json_encode([
                    'success'=> true,
                    'result'=> 1
                ]);
            }
        } else{
            return json_encode([
                'success'=> false
            ]);
        }
    }

    public function postComments(Request $request)
    {
        $comment = $request->get('comment') ?? '';
        $user_post_id = $request->get('post_id') ?? '';

        $data = new Comment();

        $data->user_id = auth()->user()->id;
        $data->post_id = $user_post_id;
        $data->comments = $comment;

        $data->save();

        Post::find($user_post_id)->increment('comments');

        return back();

    }



}
