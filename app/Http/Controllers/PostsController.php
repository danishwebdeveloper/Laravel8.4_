<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storepost;
use App\Models\BlogPost;
use App\Models\Images;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // using only and except whatever you want
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Builder $query)
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
        [
            // Do Elequent Builder Query in model and do all Queries there and call it's funciton and pass value to the relevant view('')
            'posts'=> BlogPost::withCount('comment')->get()->sortDesc(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            'mostActiveUser' => User::WithMostBlogPosts()->take(5)->get(),
            'mostBlogPosts' => User::WithMostBlogPostsLastMonths()->take(3)->get(),
            ]
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

    // For store make php artisan make:reqest Storepost and then make validation over there
    public function store(Storepost $request)
    {
        // Storepost created inside the requests
        // Plus we also post-title and post->content into the BlogPost Model as fillable
        $validated = $request->validated();

        // If Shows error of not user_id then use it as User()->current user
        // $validated['user_id'] = $request->user()->id;

        // Section without the Mass Assignment (fillable)
        // $post = new BlogPost();
        // $post->title = $validate['title'];
        // $post->content = $validate['content'];
        // $post->save();

        // Use effecient method to do that using Mass Assignment Fillable
        $post = BlogPost::create($validated);

        // For File Upload
        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->images()->save(
                Images::create(['path' => $path])
            );
            // dump($file);
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalExtension());
            // $file->store('thumbnails');
            // Storage:: disk('local')->putFile('thumbnails', $file);

            // Instead of above we can also use storeAs to specify name of image
            // $name1 = dump($file->storeAs('thumbnails', $post->id . '.' . $file->guessExtension()));
            // Storage::disk('local')->putFileAs('thumbnails', $file, $post->id . '.' . $file->guessExtension());

            // Get URL and also do php artisan Storage:link -> make link to storage
            // dump(Storage::url($name1));
            // die();
        }

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

        // Simple way to get comment
        // return view('posts.show',
        // ['post'=> BlogPost::with('comment')->findOrFail($id)]);

        // Way to get comment that latest comment come first
        return view('posts.show', ['post' => BlogPost::with(['comment' => function($query){
            return $query->orderBy('created_at', 'DESC');
        }])->findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        //Made gate in AuthServiceProvider inside provider only allow regsitered user to edit or come to that page
        if(Gate::denies('update-post', $post)){
            abort(403, "You're not allow to allow edit this blogpost");
        }
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

        //Made gate in AuthServiceProvider inside provider only allow regsitered user to edit or come to that page
        if(Gate::denies('update-post', $post)){
            abort(403);
        }

        $validated = $request->validated();
        $post->fill($validated);

        // Update / Delete Existing File
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            if ($post->images) {
                Storage::delete($post->images->path);
                $post->images->path = $path;
                $post->images->save();
            } else {
                $post->images()->save(
                    Images::create(['path' => $path])
                );
            }
        }

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

        // For deletion
        if(Gate::denies('delete-post', $post)){
            abort(403, "You're Not Allowed to Delete This Post!");
        };

        $post->delete();

        session()->flash('status', $id . ' Number Blog Post is Deleted Successfully!');
        return redirect()->route('posts.index');
    }
}
