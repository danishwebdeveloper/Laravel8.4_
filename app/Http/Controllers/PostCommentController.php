<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentUserResource;
class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index(BlogPost $post)
    {
        // Automatically converted into array and JSON
        // return $post->comment;

        // More elequent Model Seralization(Only Work if we have make:resource Comment and declare all according to need)
        // return new CommentResource($post->comment->first());

        // return CommentUserResource::collection($post->comments()->with('user')->paginate());
        return CommentUserResource::collection($post->comment()->paginate(1));

        // Return JSON
        // return $post->comment()->with('user')->get();
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
    public function store(BlogPost $post, StoreComment $request)
    {
        $post->comment()->create([
            'content' => $request->input('content'),
            // 'user_id' => $request->user()->id
        ]);

        $request->session()->flash('status', 'Comment Was Created Sussessfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComment $postComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        //
    }
}
