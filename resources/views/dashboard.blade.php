@extends('layouts.app')

@section('title')
  Profile: {{ $user->username }}
@endsection

@section('contain')
  <div class="flex justify-center"></div>
  <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
    <div class="w-8/12 lg:w-6/12 px-5">
      <img src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg') }}" alt="user image" />
    </div>
    <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">

      <div class="flex gap-2 items-center">
        @auth

          <p class="text-gray-700 text-2xl"> {{ $user->username }}</p>
          @if ($user->id === auth()->user()->id)
            <a class="text-gray-500 hover:text-gray-600" href="{{ route('profile.index') }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 36 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <title>edit</title>
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
              </svg>

            </a>
          @endif
        </div>
      @endauth

      <p class="text-gray-800 text-sm mb-3 font-bold">
        {{ $user->followers()->count() }}
        <span class="font-normal">
          {{ $user->followers()->count() === 1 ? 'follower' : 'followers' }}</span>
      </p>

      <p class="text-gray-800 text-sm mb-3 font-bold">
            {{ $user->following()->count() }}
        <span class="font-normal">
         following</span>    
      </span>
      </p>

      <p class="text-gray-800 text-sm mb-3 font-bold">
        {{ $user->posts->count() }}
        <span class="font-normal">
          {{ $user->posts->count() === 1 ? 'post' : 'posts' }}
        </span>
      </p>

      @auth
        @if ($user->id !== auth()->user()->id)
          @if (!$user->follow(auth()->user()))
            <form action="{{ route('users.follow', $user) }}" method="POST">
              @csrf
              <input type="submit" value="follow"
                class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
            </form>
          @else
            <form action="{{ route('users.unfollow', $user) }}" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="unfollow"
                class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
            </form>
          @endif
        @endif
      @endauth
    </div>

  </div>

  <section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Posts</h2>
        <x-post-list :posts="$posts" />
  </section>
@endsection
