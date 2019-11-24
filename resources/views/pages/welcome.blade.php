@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="container">
    <div class="content">
        <div class="title">Home Page</div>
        @if (Auth::check())
            <div class='quote'>You are logged in!</div>
        @else
            <div class="quote">Our Home page!</div>
        @endif
    </div>
</div>
@endsection