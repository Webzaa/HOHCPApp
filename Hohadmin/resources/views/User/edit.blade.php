@include('header')
@if(!Auth::user()->hasPermission('edit-user'))
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
                        <li class="breadcrumb-item"><a href="#">User Edit</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('User.index') }} class=" btn btn-dark mb-2">Back</a>
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
                        <form action="{{ route('User.update',$User->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>User Name:</strong>
                                            <input type="text" name="user_name" value="{{ $User->name }}" class="form-control" placeholder="User name">
                                            @error('User_name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Email:</strong>
                                            <span class="form-control">{{ $User->email }}</span>
                                            <input type="hidden" name="email" value="{{ $User->email }}" class="form-control" placeholder="Email">
                                            @error('email')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Mobile:</strong>
                                            <input type="mobile" name="mobile" value="{{ $User->mobile }}" class="form-control" placeholder="mobile">
                                            @error('mobile')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Roles:</strong>
                                            <select class="form-control select2" id="roles" name="roles">
                                                <option value="">Select Role</option>
                                                @php $role_id = ''; @endphp
                                                @if(isset($UserRole[0]->role_id))
                                                @php $role_id = $UserRole[0]->role_id; @endphp
                                                @endif
                                                @foreach ($Role as $value)
                                                <option value="{{$value->id}}" {{ ($role_id == $value->id) ? 'selected' : ''; }}>{{$value->name}}</option>
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

                                                @foreach ($UserAll as $value)
                                                @if($value->id != $User->id)
                                                <option value="{{$value->id}}" {{ ($value->id == $User->reporting_to) ? 'selected' : ''; }}>{{$value->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('reporting_to')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
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
    <title>Edit user Form</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left col-md-6">
                    <h2>Edit User</h2>
                </div>
                <div class="pull-right col-md-6" style="text-align:right;">
                    <a class="btn btn-primary" href="{{ route('User.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('User.update',$User->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input type="text" name="user_name" value="{{ $User->name }}" class="form-control"
                            placeholder="User name">
                        @error('User_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <span class="form-control">{{ $User->email }}</span>
                        <input type="hidden" name="email" value="{{ $User->email }}" class="form-control"
                            placeholder="Email">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>   
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Mobile:</strong>
                        <input type="mobile" name="mobile" value="{{ $User->mobile }}" class="form-control"
                            placeholder="mobile">
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div> 
                 
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        <select class="form-control" id="roles" name="roles">
                            <option value="">Select Role</option>
                            @php $role_id = ''; @endphp
                            @if(isset($UserRole[0]->role_id))
                                @php $role_id = $UserRole[0]->role_id; @endphp
                            @endif
                            @foreach ($Role as $value)
                                <option value="{{$value->id}}" {{ ($role_id == $value->id) ? 'selected' : ''; }}>{{$value->name}}</option>
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
                            
                             @foreach ($UserAll as $value)
                                @if($value->id != $User->id)
                                 <option value="{{$value->id}}" {{ ($value->id == $User->reporting_to) ? 'selected' : ''; }}>{{$value->name}}</option>
                                @endif
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
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html> -->