@include('header')

@if(!Auth::user()->hasPermission('edit-sales-manager'))
<script>
    window.location = "{{ route('home') }}";
</script>
@endif

@php

$project_array = array();
foreach($MapProjectSM as $value){
$project_array[] = $value->project_id;

}

@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Sales Manager Add</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('SalesManager.index') }}" class=" btn btn-dark mb-2">Back</a>
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
                        <form action="{{ route('SalesManager.update',$SalesManager->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <strong>Sales Manager Name:</strong>
                                            <input type="text" name="sm_name" class="form-control" placeholder="Sales Manager Name" value="{{ $SalesManager->sm_name }}">
                                            @error('sm_name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <strong>Email ID:</strong>
                                            <input type="email" name="email_id" class="form-control" placeholder="Email ID" value="{{ $SalesManager->email_id }}">
                                            @error('email_id')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <strong>Mobile:</strong>
                                            <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="{{ $SalesManager->mobile }}">
                                            @error('mobile')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <strong>Address:</strong>
                                            <textarea type="text" name="address" class="form-control" placeholder="Address" value=""> {{ $SalesManager->address }}</textarea>
                                            @error('address')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <strong>Employee Id:</strong>
                                            <input type="text" name="employee_id" class="form-control" placeholder="employee_id" value="{{ $SalesManager->employee_id }}">
                                            @error('employee_id')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-6 ameneties">
                                        <div class="form-group">
                                            <strong>Projects:</strong>
                                            <select class="form-control select2" id="projects" name="projects[]" multiple>
                                                @foreach($all_projects as $value)
                                                <option value="{{ $value['id'] }}" {{ (in_array($value['id'],$project_array)) ? 'selected' : '' }}>{{ $value['project_name'] }} </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-6">
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
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Sales Manager</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left col-lg-6">
                    <h2>Edit Sales Manager</h2>
                </div>
                <div class="pull-right col-lg-6" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('SalesManager.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('SalesManager.update',$SalesManager->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-lg-6">
                    <div class="form-group">
                        <strong>Sales Manager Name:</strong>
                        <input type="text" name="sm_name" class="form-control" placeholder="Sales Manager Name" value="{{ $SalesManager->sm_name }}">
                        @error('sm_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6">
                    <div class="form-group">
                        <strong>Email ID:</strong>
                        <input type="email" name="email_id" class="form-control" placeholder="Email ID" value="{{ $SalesManager->email_id }}">
                        @error('email_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6">
                    <div class="form-group">
                        <strong>Mobile:</strong>
                        <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="{{ $SalesManager->mobile }}">
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6">
                    <div class="form-group">
                        <strong>Address:</strong>
                        <textarea type="text" name="address" class="form-control" placeholder="Address"
                         value=""> {{ $SalesManager->address }}</textarea>
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Employee Id:</strong>
                        <input type="text" name="employee_id" class="form-control" placeholder="employee_id" value="{{ $SalesManager->employee_id }}">
                        @error('employee_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 mt-4 mb-4 ameneties">
                    <div class="form-group">
                        <strong>Projects:</strong>
                        <select class="form-control" id="projects" name="projects[]" multiple>
                        @foreach($all_projects as $value)                            
                            <option value="{{ $value['id'] }}" {{ (in_array($value['id'],$project_array)) ? 'selected' : '' }}>{{ $value['project_name'] }} </option>            
                        @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6">
                </div>             
               
                <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
            </div>
        </form>
    </div>
</body> -->

<script>
    $(document).ready(function() {
        $('#projects').multiselect({
            nonSelectedText: 'Select Projects'
        });
    })
</script>