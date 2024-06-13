@extends('layouts.app')

@section('title')
  Home
@endsection
@section('contain')

    <x-post-list :posts="$posts" />
@endsection

