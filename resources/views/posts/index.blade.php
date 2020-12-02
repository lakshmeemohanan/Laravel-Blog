@extends('layouts.app')
@section('content')
  <h1>Blog Posts</h1>
    @if(count($posts) > 0)
      <div class="card">
          @foreach($posts as $post)
          <ul class="list-group list-group-flush">
            <div class="row">
              <div class="col-md-4">
                <a href="/posts/{{$post->id}}" title="{{$post->title}}"><img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="{{$post->cover_image}}"></a>
              </div>
              <div class="col-md-8">
                <h3><a title="{{$post->title}}" href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Created on {{$post->created_at}} by {{$post->name}}</small>
              </div>
            <div>
          </ul>
          @endforeach
      </div>
    @else
    <ul>
      <li>
      </li>
    </ul>
    @endif
@endsection
