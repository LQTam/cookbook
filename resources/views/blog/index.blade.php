@extends('layouts.app')
@section('title','Blog')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif

        @if (count($posts) <= 0)
            <p>There is no post.</p>
        @else
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    {!! $post->title!!}
                </div>
                <div class="card-body">
                    <p class="card-text">{!! mb_substr($post->content,0,500) !!}</p>
                </div>
                {{-- <div class="card-footer text-muted">
                    Footer
                </div> --}}
            </div>
        @endforeach
        @endif
    </div>
@endsection