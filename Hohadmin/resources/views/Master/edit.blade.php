@include('header')

@if(!Auth::user()->hasPermission('edit-master'))
<script>
    window.location = "{{ route('home') }}";
</script>
@endif
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Master Edit</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('Master.index') }}" class=" btn btn-dark mb-2">Back</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('Master.update',$Master->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Type Name:</strong>
                                            <select type="text" name="type" class="form-control type select2-tags" placeholder="Type">
                                                <option value="">Select Type</option>
                                                @foreach($all_types as $value)
                                                <option value="{{ $value->type }}" {{ ( $value->type == $Master->type) ? 'selected' : '' }}>{{ $value->type }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Sub Type Name:</strong>
                                            <select type="text" name="sub_type" class="form-control type select2-tags" placeholder="Sub Type">
                                                <option value="">Select Sub Type</option>
                                                @foreach($all_sub_types as $value1)
                                                <option value="{{ $value1->sub_type }}" {{ ($value1->sub_type == $Master->sub_type) ? 'selected' : '' }}>{{ $value1->sub_type }}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_type')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Description:</strong>
                                            <textarea type="text" name="extra_info" class="form-control" placeholder="Description"></textarea>
                                            @error('extra_info')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('footer')
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Master Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Master</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('Master.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('Master.update',$Master->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Type Name:</strong>
                        <select type="text" name="type" class="form-control type" placeholder="Type">
                            <option value="">Select Type</option>
                            @foreach($all_types as $value)
                                <option value="{{ $value->type }}"{{ ( $value->type == $Master->type) ? 'selected' : '' }}>{{ $value->type }}</option>
                            @endforeach
                        </select> 
                        @error('type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Sub Type Name:</strong>
                        <select type="text" name="sub_type" class="form-control type" placeholder="Sub Type">
                            <option value="">Select Sub Type</option>
                            @foreach($all_sub_types as $value1)
                                <option value="{{ $value1->sub_type }}" {{ ($value1->sub_type == $Master->sub_type) ? 'selected' : '' }}>{{ $value1->sub_type }}</option>
                            @endforeach
                        </select> 
                        @error('sub_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea type="text" name="extra_info" class="form-control" placeholder="Description"></textarea>
                        @error('extra_info')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                </div>               
                <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body> -->
<!-- <script>
   $(".type").select2({
        tags: true,
        theme: 'bootstrap5',
    }).on('select2:select', function (e) {
        var el = $(this);
        
    })
    
    $(".sub-type").select2({
        tags: true,
        theme: 'bootstrap5',
    }).on('select2:select', function (e) {
        var el = $(this);
        
    })  
</script> -->