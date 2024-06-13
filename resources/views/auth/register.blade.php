@extends('layouts.app')

@section('title')
  Register on Devstagram
@endsection

@section('contain')
  <div class="md:flex md:justify-center md:gap-4 md:items-center">
    <div class="md:w-6/12 p-5">
      <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
      <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-5">
          <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Name</label>
          <input type="text" id="name" name="name" placeholder="Your name"
            class="border p-1 w-full rounded-lg @error('name') 
                        border-red-500 @enderror"
            value="{{ old('name') }}">
          @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">username </label>
          <input type="text" id="username" name="username" placeholder="Your username"
            class="border p-1 w-full rounded-lg @error('username') 
                        border-red-500 @enderror"
            value="{{ old('username') }}">
          @error('username')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
          <input type="text" id="email" name="email" placeholder="Your email"
            class="border p-1 w-full rounded-lg @error('email') 
                        border-red-500 @enderror"
            value="{{ old('email') }}">


          @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">password</label>
          <input type="password" id="password" name="password" placeholder="Your password"
            class="border p-1 w-full rounded-lg @error('password') 
                        border-red-500 @enderror">

          @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Reite your
            password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite password"
            class="border p-1 w-full rounded-lg">
        </div>

        <input type="submit" value="Create account"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-1 text-white rounded-lg">
      </form>
    </div>

  </div>
@endsection
