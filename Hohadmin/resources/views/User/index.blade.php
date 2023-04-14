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
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-user'))
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('User.create') }}"> Create User</a>
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
                                        <th>Email Id</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_Users as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->role_name }}</td>
                                        <td>
                                            <form action="{{ route('User.destroy',$value->id) }}" method="Post">
                                                @if(Auth::user()->hasPermission('edit-user'))
                                                <a href="{{ route('User.edit',$value->id) }}"
                                                    style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a data-id="{{ $value->id }}" data-type="IP" data-name="{{ $value->name }}" id="view_history" data-toggle="modal" data-target="#myModal"
                                                    style="color: black;"><i title="IP wise data" class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                                <a data-id="{{ $value->id }}" data-type="Location" data-name="{{ $value->name }}" id="view_history" data-toggle="modal" data-target="#myModal"
                                                    style="color: black;"><i  title="Location wise data" class="fas fa-map-marker"></i></a>&nbsp;&nbsp;
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-user'))
                                                <button type="submit" style="border: none;"><i
                                                        class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $all_Users->links() !!}
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="append-data">
                       
                    </tbody>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@include('footer')

<script>
    $(document).ready(function () {

        $(document).on('click', '#view_history', function (event) {

            var fd = new FormData();
            var id = $(this).data('id');
            var type = $(this).data('type');
            var name = $(this).data('name');
            

            fd.append('user_id', id);

            $.ajax({

                url: 'https://cpapp.houseofhiranandani.com/Hohadmin/public/api/GetUserLoginHistory',
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {

                   var html = '';

                   if(type == 'IP'){
                        if(data.IP_data.length > 0){
                            $.each(data.IP_data, function(arr, i){
                                html+= '<tr>';
                                html+= '<td>'+i.ip_address+'</td>';
                                html+= '<td>'+i.latitude+'</td>';
                                html+= '<td>'+i.longitude+'</td>';
                                html+= '<td>'+i.date+'</td>';
                                html+= '<tr>';
                            })                        
                        }
                        else{
                            html+= '<tr><td colspan="4">No reocord Found</tr>';
                        }

                   }
                   else{

                        if(data.Location_data.length > 0){
                            $.each(data.Location_data, function(arr, i){
                                html+= '<tr>';
                                html+= '<td></td>';
                                html+= '<td>'+i.latitude+'</td>';
                                html+= '<td>'+i.longitude+'</td>';
                                html+= '<td>'+i.created_date+'</td>';
                                html+= '<tr>';
                            })                        
                        }
                        else{
                            html+= '<tr><td colspan="4">No reocord Found</tr>';
                        }


                   }
                   

                   $(".append-data").html(html);
                   $(".modal-title").html(name);

                }

            })
        });


        $(document).on('click', '.delete-collateral', function () {
            $(this).parent().parent().remove();
        });
    });
</script>