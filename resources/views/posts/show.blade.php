@extends('layouts.app')

@section('title')
  {{ $post->title }}
@endsection


@section('contain')
  <div class="container mx-auto md:flex">
    <div class="md:w-1/2">
      <img src="{{ asset('uploads') . '/' . $post->image }}" alt="post image{{ $post->title }}">
      <div class="p-3 flex items-center gap-4">
        @auth
          <livewire:like-post :post="$post" />
        @endauth

      </div>
      <div>
        <p class="font-bold">{{ $post->user->username }}</p>
        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
        <p class="mt-5"> {{ $post->description }}</p>

      </div>

      @auth
        @if ($post->user_id == auth()->user()->id)
          <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" value="Delete Post"
              class="bg-red-500 hover:bg-red-600 rounded text-white font-bold cursor-pointer p-2 mt-4">
          </form>
        @endif
      @endauth

    </div>
    <div class="md:w-1/2">
      <div class="shadow bg-white p-5 mb-5">
        @auth

          <p class="text-xl font-bold text-center mb-4">Add a new comment</p>
          @if (session('message'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
              {{ session('message') }} </div>
          @endif

          <form method="POST" action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}">
            @csrf
            <div class="mb-5">
              <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">comment</label>
              <textarea id="comment" name="comment" placeholder="comment"
                class="border p-1 w-full rounded-lg @error('comment') 
            border-red-500 @enderror"></textarea>

              @error('comment')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
              @enderror
            </div>

            <input type="submit" value="comment"
              class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-1 text-white rounded-lg">
          </form>

        @endauth

        <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10">
          @if ($post->comments->count())
            @foreach ($post->comments as $comment)
              <div class="p-5 border-gray-300 border-b">
                <a class="font-bold"
                  href="{{ route('posts.index', $comment->user) }}">{{ $comment->user->username }}</a>
                <p>{{ $comment->comment }}</p>
                <p>{{ $comment->created_at->diffForHumans() }}</p>

              </div>
            @endforeach
          @else
            <p class="p-10 text-center">There is no comments</p>
          @endif

        </div>
      </div>
    </div>
  </div>
@endsection
