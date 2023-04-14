@include('header')
@if(!Auth::user()->hasPermission('add-user'))
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
                        <li class="breadcrumb-item"><a href="#">User Add</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('User.index') }}" class=" btn btn-dark mb-2">Back</a>
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
                        <form id="StoreUser" action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>User Name:</strong>
                                            <input type="text" name="user_name" class="form-control" placeholder="User Name">
                                            @error('user_name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Email:</strong>
                                            <input type="text" name="email" class="form-control" placeholder="Email">
                                            @error('email')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Mobile:</strong>
                                            <input type="text" name="mobile" class="form-control" placeholder="Mobile">
                                            @error('location')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Password:</strong>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                            @error('location')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Confirm Password:</strong>
                                            <input type="password" name="cnfpassword" id="cnfpassword" class="form-control" placeholder="Confirm Password">
                                            @error('location')
                                            <div class="alert alert-danger mt-1 mb-1 cnf-pwd">{{ $message }}</div>
                                            @enderror
                                            <div class="alert alert-danger mt-1 mb-1 cnf-pwd" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Roles:</strong>
                                            <select class="form-control select2" id="roles" name="roles">
                                                <option value="">Select Role</option>

                                                @foreach ($Role as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('mobile')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Reporting Manager:</strong>
                                            <select class="form-control select2" id="reporting_to" name="reporting_to">
                                                <option value="">Select Manager</option>

                                                @foreach ($User as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('reporting_to')
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
    <title>Add User Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left mb-2 col-md-6">
                    <h2>Add User</h2>
                </div>
                <div class="pull-right col-md-6" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('User.index') }}">Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form id="StoreUser" action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input type="text" name="user_name" class="form-control" placeholder="User Name">
                        @error('user_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Mobile:</strong>
                        <input type="text" name="mobile" class="form-control" placeholder="Mobile">
                        @error('location')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        @error('location')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 ">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        <input type="password" name="cnfpassword"  id="cnfpassword" class="form-control" placeholder="Confirm Password">
                        @error('location')
                        <div class="alert alert-danger mt-1 mb-1 cnf-pwd">{{ $message }}</div>
                        @enderror
                        <div class="alert alert-danger mt-1 mb-1 cnf-pwd" style="display: none;"></div>
                    </div>
                </div>
                 
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        <select class="form-control" id="roles" name="roles">
                            <option value="">Select Role</option>
                           
                            @foreach ($Role as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div> 
                 
                 <div class="col-xs-12 col-sm-12 col-md-6">
                     <div class="form-group">
                         <strong>Reporting Manager:</strong>
                         <select class="form-control" id="reporting_to" name="reporting_to">
                             <option value="">Select Manager</option>
                            
                             @foreach ($User as $value)
                                 <option value="{{$value->id}}">{{$value->name}}</option>
                             @endforeach
                         </select>
                         @error('reporting_to')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                         @enderror
                     </div>
                 </div> 
                 <div class="col-xs-12 col-sm-12 col-md-6">
                 </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-4">
                    <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body> -->
<script>
    $(document).on('submit', '#StoreUser', function(e) {
        e.preventDefault();
        if ($("#cnfpassword").val() != $("#password").val()) {
            $(".cnf-pwd").html('Password not match');
            $(".cnf-pwd").show();
        } else {
            $(this)[0].submit();
        }



    })
</script>