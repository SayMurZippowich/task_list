@extends('main')
@section('title','Task_List')
@section('content')
  <div class="row btn-h1-spacing">
    <div class="col-md-12">
      <div class="jumbotron">
        <h1 class="display-4">Taks app</h1>
        <p class="lead">Your personal task manger</p>
        <p>Continue work by:</p>
        <a class="btn btn-earls-green btn-lg" href="{{ route('login') }}" role="button">Login</a>
        <hr class="my-4">
        <p>Or start with:</p>
        <a class="btn btn-brown-tank btn-lg" href="{{ route('register') }}" role="button">Sing up</a>
      </div>
    </div>
  </div> <!--/.row -->
@endsection
