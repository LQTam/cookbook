@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div><img src="/images/52274877_1079736198878726_6931433271297310720_n.jpg" alt="image" width="100%"></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('image.store')}}" enctype="multipart/form-data" method="post">
                    
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                        
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="image">Choose an image</label>
                          <input type="file" name="image" id="image" />
                        </div>

                        <button type="submit" class="btn btn-outline-secondary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
