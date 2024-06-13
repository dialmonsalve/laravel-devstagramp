@extends('layouts.app')

@section('title')
  Create a new publications
@endsection

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contain')
  <div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
      <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
        class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
        @csrf

      </form>
    </div>
    <div class="md:w-1/2 bg-white p-10 rounded shadow-xl">
      <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-5">
          <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">title</label>
          <input type="text" id="title" name="title" placeholder="title post"
            class="border p-1 w-full rounded-lg @error('title') 
                  border-red-500 @enderror"
            value="{{ old('title') }}">
          @error('title')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">description</label>
          <textarea id="description" name="description" placeholder="description"
            class="border p-1 w-full rounded-lg @error('description') 
                  border-red-500 @enderror">{{ old('description') }}</textarea>

          @error('description')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>
        
        <div>
          <input type="hidden" name="image" value="{{old('image')}}" >
          @error('image')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
            
          @enderror
        </div>


        <input type="submit" value="Post"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-1 text-white rounded-lg">
      </form>
    </div>
  </div>
@endsection
