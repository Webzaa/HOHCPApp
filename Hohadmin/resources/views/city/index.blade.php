@include('header')
@if(!Auth::user()->hasPermission('view-city'))
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
                        <li class="breadcrumb-item"><a href="#">City</a></li>
                    </ol>
                </div>
                @if(Auth::user()->hasPermission('add-city'))
                    <div class="col-sm-6">
                        <div class="col-md-12 text-right">
                        <a class="btn btn-primary mb-2" href="{{ route('city.create') }}"> Create City</a>
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
                                        <th>City Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($city as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->city_name }} - {{ $value->location }}</td>
                                        <td>
                                            <form action="{{ route('city.destroy',$value->id) }}" method="Post">
                                                @if(Auth::user()->hasPermission('edit-city'))
                                                <a href="{{ route('city.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->hasPermission('delete-city'))
                                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                            {!! $city->links() !!}
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
<div class="col-lg-10">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Laravel 9 CRUD Tutorial Example</title>
    </head>
    <style>
        main.py-4 {
    padding: 0 20px;
    width: 100%;
}
    </style>
    <body>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb row" style="margin-bottom: 35px;">
                    <div class="pull-left col-lg-6">
                        <h2>City</h2>
                    </div>
                    @if(Auth::user()->hasPermission('add-city'))
                    <div class="pull-right mb-2 col-lg-6" style="text-align: right;">
                        <a class="btn btn-success" href="{{ route('city.create') }}"> Create City</a>
                    </div>
                    @endif
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-hover" style="text-align: center;">
                <thead class="thead" style="background-color: #87662d !important;color:#fff">
                    <tr>
                        <th>S.No</th>
                        <th>City Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($city as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->city_name }} - {{ $value->location }}</td>
                        <td>
                            <form action="{{ route('city.destroy',$value->id) }}" method="Post">
                                @if(Auth::user()->hasPermission('edit-city'))
                                <a href="{{ route('city.edit',$value->id) }}" style="    color: black;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                @endif
                                @csrf
                                @method('DELETE')
                                @if(Auth::user()->hasPermission('delete-city'))
                                <button type="submit" style="border: none;"><i class="fa fa-trash"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $city->links() !!}
        </div>
    </body>

    </html>
</div>
</div>
</div> -->
