@include('header')
@if(!Auth::user()->hasPermission('view-project'))
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
                        <li class="breadcrumb-item"><a href="#">Project</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-project'))
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('project.create') }}"> Create Project</a>
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
                                        <th scope="col">S.No</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Configuration</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Status</th>
                                        <th width="280px">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $cnt = 1; @endphp
                                    @foreach ($project as $value)
                                    <tr>
                                        <td>{{ $cnt++ }}</td>
                                        <td>{{ $value->project_name }}</td>
                                        <td>{{ $value->configuration }}</td>
                                        <td>{{ $value->price }}</td>
                                        <td>{{ $value->city_name }}</td>
                                        <td>
                                            @if($value->is_active == 1)
                                            <a href="{{url('/project-active',$value->id)}}" class="btn btn-success btn-sm">Active</a>

                                            @else
                                            <a href="{{url('/project-active',$value->id)}}" class="btn btn-danger btn-sm">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('project.destroy',$value->id) }}" method="Post">
                                                @if(Auth::user()->hasPermission('edit-project'))
                                                <a href="{{ route('project.edit',$value->id) }}" style="    color: black;"> <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('download/'.$value->id) }}" style="color: black;"> <i class="fa fa-download"></i></a>&nbsp;&nbsp;
                                                @if(Auth::user()->hasPermission('delete-project'))
                                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $project->links() !!}
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

<div class="">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Projects</title>
    </head>

    <body>

        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb row" style="margin-bottom: 35px;">
                    <div class="pull-left col-lg-6">
                        <h2>Project</h2>
                    </div>
                    @if(Auth::user()->hasPermission('add-project'))
                        <div class="pull-right mb-2 col-lg-6" style="text-align: right;">
                            <a class="btn btn-success" href="{{ route('project.create') }}"> Create Project</a>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('project.index') }}" method="GET" class="row" style="    margin-bottom: 20px;">
                <div class="form-group col-9">
                    <input type="text" name="search" class="form-control" id="search" placeholder="Search..." value="{{$search}}">
                </div>
                <div class="form-group col-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url('/project') }}"><button type="button" class="btn btn-primary">Reset</button></a>
                </div>
            </form>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover" style="text-align: center;">
                    <thead class="thead" style="background-color: #87662d !important;color:#fff">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Configuration</th>
                            <th scope="col">Price</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            @if(Auth::user()->role_id == "1")
                            <th width="280px">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $cnt = 0; @endphp
                        @foreach ($project as $value)
                        @php $cnt++; @endphp
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $value->project_name }}</td>
                            <td>{{ $value->configuration }}</td>
                            <td>{{ $value->price }}</td>
                            <td>{{ $value->city_name }}</td>
                            <td>
                                @if($value->is_active == 1)
                                <a href="{{url('/project-active',$value->id)}}" class="btn btn-success btn-sm">Active</a>

                                @else
                                <a href="{{url('/project-active',$value->id)}}" class="btn btn-danger btn-sm">Inactive</a>
                                @endif
                            </td>


                            @if(Auth::user()->role_id == "1")
                            <td>
                                <form action="{{ route('project.destroy',$value->id) }}" method="Post">
                                @if(Auth::user()->hasPermission('edit-project'))
                                    <a href="{{ route('project.edit',$value->id) }}" style="    color: black;"> <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                @endif
                                    @csrf
                                    @method('DELETE')
                                   
                                    <a href="{{ url('download/'.$value->id) }}" style="color: black;"> <i class="fa fa-download"></i></a>&nbsp;&nbsp;
                                @if(Auth::user()->hasPermission('delete-project'))
                                    <button type="submit"  style="border: none;"><i class="fa fa-trash"></i></button>
                                @endif
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </body>

    </html>
</div>
</div>
</div> -->