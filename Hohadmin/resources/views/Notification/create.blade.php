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
                        <li class="breadcrumb-item"><a href="#">Send Notification</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('Notification.index') }}" class=" btn btn-dark mb-2">Back</a>
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
                        <form id="StoreUser" action="{{ route('Notification.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    
                                  
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Title:</strong>
                                            <input type="text" name="title" class="form-control" placeholder="Title">
                                            @error('title')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ">
                                        <div class="form-group">
                                            <strong>Message:</strong>
                                            <textarea name="msg_body" class="form-control" placeholder="Message"></textarea> 
                                            @error('msg_body')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Users:</strong>
                                            <select class="form-control select2" id="id_users" name="id_users[]" multiple>
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
                                    <div class="col-xs-12 col-sm-12 col-md-6 mt-4">
                                        <div class="form-group">
                                            <strong>Schedule Type:</strong>
                                            <input type="radio" class="schedule-type" id="now" name="schedule_type" value="now" checked>
                                            <label for="now">Schedule Now</label>
                                            <input type="radio" class="schedule-type" id="later" name="schedule_type" value="later">
                                            <label for="later">Schedule Later</label>
                                            @error('msg_body')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" id="schedule_date"  style="display: none;">
                                        <div class="form-group">
                                            <strong>Schedule Type:</strong>
                                            <input type="datetime-local" class="form-control"  name="schedule_date" value="">
                                            @error('msg_body')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <button type="submit" class="btn btn-primary">Send</button>
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

<script type="text/javascript">
    
    $(document).on('click','.schedule-type',function(){
        if($("input[name='schedule_type']:checked").val() == 'later'){
            $("#schedule_date").show();
        }
        else{
            $("#schedule_date").hide();
        }

    })
</script>
