<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storepost;
use App\Models\BlogPost;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // private $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'This is a short intro to Laravel',
    //         'is_new' => true,
    //         'has_comment' => true
    //     ],
    //     2 => [
    //         'title' => 'Intro to PHP',
    //         'content' => 'This is a short intro to PHP',
    //         'is_new' => false,
           
    //     ],
    //     3 => [
    //         'title' => 'Intro to GoLang',
    //         'content' => 'This is a short intro to Golang',
    //         'is_new' => false,
           
    //     ]
    // ];

    public function index()
    {
        // Query Builder using with we can access all but they have comment will access in one array[]
        // DB::enableQueryLog();
        // $posts = BlogPost::with('comment')->get();

        // foreach($posts as $post){
        //     foreach($post->comment as $comment){
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQueryLog());

        return view('Posts.index', 
        ['posts'=> BlogPost::withCount('comment')->get()]
    );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    public function store(Storepost $request)
    {
        // Storepost created inside the requests
        // Plus we also post-title and post->content into the BlogPost Model
        $validated = $request->validated();

        // Section without the Mass Assignment (fillable)
        // $post = new BlogPost();
        // $post->title = $validate['title'];
        // $post->content = $validate['content'];
        // $post->save();

        // Use effecient method to do that using Mass Assignment Fillable
        $post = BlogPost::create($validated);

        // Delaration but use it in the main layout.app
        $request->session()->flash('status', 'The Blog Post has Created Sussessfully!');

        return redirect()->route('posts.show', ['post'=> $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        
        // return view('Posts.index', ['posts'=> $this->posts]);

        return view('posts.show', 
        ['post'=> BlogPost::with('comment')->findOrFail($id)]
    
    );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('Posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Storepost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        // Now put some flash message and redirect
        $request->session()->flash('status', 'the post is updated successfully!');

        return redirect()->route('posts.show', ['post'=> $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dump and die
        // dd($id);

        $post = BlogPost::findOrFail($id);
        $post->delete();

        session()->flash('status', $id . ' Number Blog is Deleted');
        return redirect()->route('posts.index');
    }
}
