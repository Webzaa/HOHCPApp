
@include('header')
@if(!Auth::user()->hasPermission('view-channel-partner'))
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
                        <li class="breadcrumb-item"><a href="#">Channel Partner</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-channel-partner'))
                    <div class="col-sm-6">
                        <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('ChannelPartner.create') }}""> Create Channel Partner</a>
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
                                        <th>Channel Partner Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Departments</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($ChannelPartner as $value)
                                    <tr>
                                    <td>{{ $value->id }}</td>
                                        <td>{{ $value->cp_name }}</td>
                                        <td>{{ $value->email_id }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->departments }}</td>
                                        <td>
                                        @if($value->is_active == 1)
                                            <a href="{{url('/cp-active',$value->id)}}" class="btn btn-success btn-sm">Active</a>
                                                        
                                        @else
                                            <a href="{{url('/cp-active',$value->id)}}" class="btn btn-danger btn-sm">Inactive</a>
                                        @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('ChannelPartner.destroy',$value->id) }}" method="Post">
                                            @if(Auth::user()->hasPermission('edit-channel-partner'))
                                                <a href="{{ route('ChannelPartner.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-channel-partner'))
                                                    <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $ChannelPartner->links() !!}
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

<script>
    
</script>
@include('footer')
