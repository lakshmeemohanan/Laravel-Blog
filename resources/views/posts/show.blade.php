@extends('layouts.app')
@section('content')
  <a href="/posts" class="btn btn-default bck-link">Back</a>
  <h1>{{$post->title}}</h1>
  <div class="row">
    <div class="col-md-12">
      <img src="/storage/cover_images/{{$post->cover_image}}" alt="" style="width:100%">
    </div>
  </div>
  <p>{{$post->body}}</p>
  <hr>
  <small>Created on {{$post->created_at}} by {{$post->name}}</small>
  <hr>
@endsection
