@extends('layouts.app')
@section('content')
  <h1>Create a Blog Post</h1>
  {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Description')}}
      {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>
    {{Form::submit('Submit',['class' =>'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection
