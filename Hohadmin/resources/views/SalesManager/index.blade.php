@include('header')
@if(!Auth::user()->hasPermission('view-sales-manager'))
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
                        <li class="breadcrumb-item"><a href="#">Sales Manager</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-sales-manager'))
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('SalesManager.create') }}"> Create Sales Manager</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Sales Manager Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Employee ID</th>
                                        <th>Company Name</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SalesManager as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->sm_name }}</td>
                                        <td>{{ $value->email_id }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->employee_id }}</td>
                                        <td>{{ $value->company_name }}</td>
                                        <td>
                                            @if($value->is_active == 1)
                                            <a href="{{url('/sm-active',$value->id)}}" class="btn btn-success btn-sm">Active</a>

                                            @else
                                            <a href="{{url('/sm-active',$value->id)}}" class="btn btn-danger btn-sm">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('SalesManager.destroy',$value->id) }}" method="Post">
                                                @if(Auth::user()->hasPermission('edit-sales-manager'))
                                                <a href="{{ route('SalesManager.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-sales-manager'))
                                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $SalesManager->links() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
    <title>Sales Managers</title>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row" style="margin-bottom: 35px;">
                <div class="pull-left col-lg-6">
                    <h2>Sales Manager</h2>
                </div>
                @if(Auth::user()->hasPermission('add-sales-manager')) 
                    <div class="pull-right mb-2 col-lg-6" style="text-align: right;">
                        <a class="btn btn-success" href="{{ route('SalesManager.create') }}"> Create Sales Manager</a>
                    </div>
                @endif
            </div>
        </div>
        
        <form action="{{ route('SalesManager.index') }}" method="GET"class="row" style="    margin-bottom: 20px;">
            <div class="form-group col-9">              
                <input type="text" name="search" class="form-control" id="search" placeholder="Search..." value="{{$search}}">              
            </div>
            <div class="form-group col-3">  
                 <button type="submit" class="btn btn-primary">Submit</button>
                 <a href="{{ url('/SalesManager') }}"><button type="button" class="btn btn-primary">Reset</button></a>
            </div>
        </form>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-hover" style="text-align: center;">
            <thead class="thead" style="background-color: #87662d !important;color:#fff">
                <tr>
                    <th>S.No</th>
                    <th>Sales Manager Name</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Employee ID</th>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($SalesManager as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->sm_name }}</td>
                        <td>{{ $value->email_id }}</td>
                        <td>{{ $value->mobile }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->employee_id }}</td>
                        <td>{{ $value->company_name }}</td>
                        <td>
                        @if($value->is_active == 1)
                            <a href="{{url('/sm-active',$value->id)}}" class="btn btn-success btn-sm">Active</a>
                                         
                        @else
                            <a href="{{url('/sm-active',$value->id)}}" class="btn btn-danger btn-sm">Inactive</a>
                        @endif
                        </td>
                        <td>
                            <form action="{{ route('SalesManager.destroy',$value->id) }}" method="Post">
                            @if(Auth::user()->hasPermission('edit-sales-manager')) 
                                <a href="{{ route('SalesManager.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            @endif
                                @csrf
                                @method('DELETE')
                            @if(Auth::user()->hasPermission('delete-sales-manager')) 
                                <button type="submit"  style="border: none;"><i class="fa fa-trash"></i></button>
                            @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
       
    </div>
</body>
</html> -->