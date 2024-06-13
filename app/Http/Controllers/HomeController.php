<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class HomeController extends Controller implements HasMiddleware
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    public function __invoke()
    {
        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view("home", [
            'posts' => $posts
        ]);
    }
}
