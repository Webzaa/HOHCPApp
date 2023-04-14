@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Project Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Project</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('ProjectCollateral.index') }}"
                        enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('ProjectCollateral.update',$ProjectCollateral[0]->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Projects:</strong>
                        <select class="form-control" id="project_id" name="project_id">
                            @foreach($all_projects as $value)
                            <option value="{{ $value['id'] }}" {{ ($value['id']==$ProjectCollateral[0]->project_id )?
                                'selected':'' }}>{{ $value['project_name'] }} </option>
                            @endforeach
                        </select>
                        @error('project_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Project Name:</strong>
                        <select class="form-control" id="collateral_type" name="collateral_type">
                            @foreach($CollateralTypes as $collateral)
                            <option value="{{ $collateral['id'] }}" {{ ($collateral['id']==$ProjectCollateral[0]->
                                collateral_type )? 'selected':'' }}>{{ $collateral['name'] }} </option>
                            @endforeach
                        </select>
                        @error('collateral_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if(Auth::user()->role_id == "1")
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email ID:</strong>
                        <input type="file" name="files[]" placeholder="Choose files" multiple>
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
                <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
                @endif
            </div>
        </form>

    </div>
    
    @if($ProjectCollateral[0]->pathnames != '')
        @php                       
             $images = explode(',',$ProjectCollateral[0]->pathnames);
        @endphp
        <div class="container mt-5">
            <div class="row col-lg-12">  
            
            @foreach($images as $image)
                
                @php 
                    $collaterimage  = explode('|',$image);
                @endphp
                <div class="card text-white mb-3 col-lg-4">
                    <div class="card-header" style="text-align: right;">
                    @if(Auth::user()->role_id == "1")
                        <i class="fa-solid fa-trash-can deleteRecord" data-id="{{ $collaterimage[1] }}" style="color: black;"></i>
                    @endif
                </div>
                    <div class="card-body">
                    <img class="d-block w-100" src="../../{{ $collaterimage[0] }}" style="height: 300px;">
                
                    </div>
                </div>
            @endforeach    
            </div>
        </div>
        @endif
</body>
<script>
    $(".deleteRecord").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
    
        $.ajax(
        {
            url: "../../CollateralImage/"+id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (){
                console.log("it Works");
            }
        });
    
    });
</script>
</html>

@endsection