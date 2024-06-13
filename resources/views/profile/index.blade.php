@extends('layouts.app')

@section('title')
  Edit profile: {{ auth()->user()->username }}
@endsection

@section('contain')
  <div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
      <form class="mt-10 md:mt-0" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
          <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
          <input type="text" id="username" name="username" placeholder="Your username"
            class="border p-1 w-full rounded-lg @error('name') 
                        border-red-500 @enderror"
            value="{{ auth()->user()->username }}">
          @error('username')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">image</label>
          <input type="file" id="image" name="image" class="border p-1 w-full rounded-lg">
          <input type="submit" value="update account"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-1 text-white rounded-lg mt-5">
        </div>

      </form>
    </div>
  </div>
@endsection
