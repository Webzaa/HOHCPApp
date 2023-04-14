@include('header')
@if(!Auth::user()->hasPermission('view-lead'))
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
                        <li class="breadcrumb-item"><a href="#">Lead</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-lead'))
                    <div class="col-sm-6">
                        <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('lead.create') }}"> Create Lead</a>
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
                                        <th>Created Date</th>
                                        <th>lead Name</th>
                                        <!-- <th>Mobile</th>
                                        <th>Email Id</th> -->
                                        <th>Location</th>
                                        <th>Channel Partner</th>
                                        <th>Projects</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lead as $value)
                                    <tr>

                                        <td>{{ $value->id }}</td>
                                        <td>@php echo date('d/m/Y H:i:s', strtotime($value->created_date)); @endphp</td>
                                        <td>{{ $value->name }}</td>
                                        <!-- <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->email }}</td> -->
                                        <td>{{ $value->location }}</td>
                                        <td>{{ $value->cp_name }}</td>
                                        <td>{{ $value->project_name }}</td>
                                        <td>
                                            @if($value->is_verified == '')

                                            Pending
                                                 <!-- <a href="{{url('/lead-status-approved',$value->id)}}" class="btn btn-success btn-sm">Approve</a>
                                                 <a href="{{url('/lead-status-rejected',$value->id)}}" class="btn btn-success btn-sm" style="background: red;">Reject</a> -->
                                            @else
                                                {{ $value->is_verified }}
                                            @endif

                                            <!-- <form action="{{ route('lead.destroy',$value->id) }}" method="Post">                                               
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-lead'))
                                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form> -->

                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                           
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


