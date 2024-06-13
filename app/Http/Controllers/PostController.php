<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }
    //
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:30',
            'description' => 'required|min:3',
            // 'image' => 'required|min:3',
        ]);

        // Post::create([
        //     'title' => $request["title"],
        //     'description' => $request["description"],
        //     'image'=>"", //Pending allow images
        //     'user_id' => auth()->user()->id,
        // ]);

        $request->user()->posts()->create([
            'title' => $request["title"],
            'description' => $request["description"],
            'image' => "", //Pending allow images
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            "post" => $post,
            "user" => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        Gate::allows('delete', $post);
        $post->delete();
        // $imagePath = public_path('uploads/' . $post->image);
        // if(File::exists($imagePath)){
        //     unlink($imagePath);
        // }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
