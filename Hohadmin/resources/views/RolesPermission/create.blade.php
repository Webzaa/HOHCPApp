@extends('layouts.app')

@section('content')

@if(Auth::user()->role_id != "1")
    <script>window.location = "{{ route('home') }}";</script>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add City Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left mb-2 col-md-5">
                    <h2>Add City</h2>
                </div>
                <div class="pull-right col-md-5" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('city.index') }}">Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('city.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 ">
                    <div class="form-group">
                        <strong>City Name:</strong>
                        <input type="text" name="city_name" class="form-control" placeholder="City Name">
                        @error('city_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 ">
                    <div class="form-group">
                        <strong>Location:</strong>
                        <input type="text" name="location" class="form-control" placeholder="Location">
                        @error('location')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-5 mt-4">
                    <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

@endsection