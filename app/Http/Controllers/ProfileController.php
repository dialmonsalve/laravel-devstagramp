<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller implements HasMiddleware
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
    public function index()
    {
        return view('profile.index');
    }
    public function store(Request $request)
    {
        $request->request->add(["username" => Str::slug($request["username"])]);
        $request->validate([
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,edit-profile'],
        ]);

        if ($request["image"]) {
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
    
            $serverImage = Image::make($image);
    
            $serverImage->fit(1000, 1000);
    
            $pathImage = public_path('profiles') . '/' . $imageName;
    
            $serverImage->save($pathImage);
    
        }
            $user = User::find(auth()->user()->id);
            $user->username = $request["username"];
            $user->image = $imageName ?? auth()->user()->img ?? null;
    
            $user->save();
            return redirect()->route('posts.index', $user->username);
    }
}
