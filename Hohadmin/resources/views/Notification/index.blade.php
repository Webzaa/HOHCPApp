@include('header')
@if(!Auth::user()->hasPermission('view-user'))
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
                        <li class="breadcrumb-item"><a href="#">Notification</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-user'))
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('Notification.create') }}"> Send Notification</a>
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
                                        <th>User Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AllNotifications as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->msg_body }}</td>
                                        <td>{{ $value->created_date }}</td>
                                        <td>
                                            <form action="{{ route('User.destroy',$value->id) }}" method="Post">
                                                @if(Auth::user()->hasPermission('edit-user'))
                                                <a href="{{ route('User.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-user'))
                                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $AllNotifications->links() !!}
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

