@extends('layouts.app')

@section('content')



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Project Collateral Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Project Collateral</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('ProjectCollateral.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif

        <!-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->

        <form action="{{ route('ProjectCollateral.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Projects:</strong>
                        <select class="form-control" id="project_id" name="project_id">
                        @foreach($all_projects as $value)                            
                            <option value="{{ $value['id'] }}">{{ $value['project_name'] }} </option>            
                        @endforeach
                        </select>
                        @error('project_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Collateral Types:</strong>
                        <select class="form-control" id="collateral_type" name="collateral_type">
                        @foreach($CollateralTypes as $collateral)                            
                            <option value="{{ $collateral['id'] }}">{{ $collateral['name'] }} </option>            
                        @endforeach 
                        </select>   
                        @error('collateral_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if(Auth::user()->role_id == "1")
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Files:</strong>
                        <input type="file" name="files[]" placeholder="Choose files" multiple >
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div> 

               
                <button type="submit" class="btn btn-primary ml-3 col-lg-2 offset-lg-4">Submit</button>
                @endif
            </div>
        </form>
    </div>
</body>

</html>
@endsection