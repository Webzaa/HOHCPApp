@include('header')

@if(!Auth::user()->hasPermission('edit-channel-partner'))
<script>
    window.location = "{{ route('home') }}";
</script>
@endif
@php

$project_array = array();
foreach($MapProjectCP as $value){
$project_array[] = $value->project_id;

}

@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Channel Partner Add</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('ChannelPartner.index') }}" class=" btn btn-dark mb-2">Back</a>
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
                        <form action="{{ route('ChannelPartner.update',$ChannelPartner->id) }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Channel Partner Name:</strong>
                                            <input type="text" name="cp_name" class="form-control" placeholder="Channel Partner Name" value="{{ $ChannelPartner->cp_name }}">
                                            @error('cp_name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Email ID:</strong>
                                            <input type="email" name="email_id" class="form-control" placeholder="Email ID" value="{{ $ChannelPartner->email_id }}">
                                            @error('email_id')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Mobile:</strong>
                                            <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="{{ $ChannelPartner->mobile }}">
                                            @error('mobile')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Address:</strong>
                                            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $ChannelPartner->address }}">
                                            @error('address')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Projects:</strong>

                                            <select class="form-control" id="projects" name="projects[]" multiple>
                                                @php
                                                $projects = explode(',',$ChannelPartner->projects);
                                                @endphp
                                                @foreach($all_projects as $value)
                                                <option value="{{ $value['id'] }}" {{ (in_array($value['id'],$project_array)) ? 'selected' : '' }}>{{ $value['project_name'] }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Campany Name:</strong>
                                            <input type="text" name="campany_name" class="form-control" placeholder="Campany Name" value="{{ $ChannelPartner->campany_name }}">
                                            @error('address')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Campany Address:</strong>
                                            <input type="text" name="company_address" class="form-control" placeholder="Campany Address" value="{{ $ChannelPartner->company_address }}">
                                            @error('address')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>GST No.:</strong>
                                            <input type="text" name="gstno" class="form-control" placeholder="GST No." value="{{ $ChannelPartner->gstno }}">
                                            @error('address')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Rera No.:</strong>
                                            <input type="text" name="rerano" class="form-control" placeholder="Rera No." value="{{ $ChannelPartner->rerano }}">
                                            @error('rerano')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>A/C No.:</strong>
                                            <input type="text" name="acc_no" class="form-control" placeholder="A/C No." value="{{ $ChannelPartner->acc_no }}">
                                            @error('acc_no')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>IFSC:</strong>
                                            <input type="text" name="ifsc" class="form-control" placeholder="IFSC" value="{{ $ChannelPartner->ifsc }}">
                                            @error('ifsc')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>CP ID:</strong>
                                            <input type="text" name="cp_id" class="form-control" placeholder="CP ID" value="{{ $ChannelPartner->cp_id }}">
                                            @error('cp_id')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <strong>Rera Certificate:</strong>
                                            <input type="file" class="form-control" name="rera_certificate_path" placeholder="Choose files">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-1 mt-4">
                                        <div class="form-group">
                                            <strong>&nbsp;</strong>
                                            @if($ChannelPartner->rera_certificate_path != '')

                                            <button data="{{ asset($ChannelPartner->rera_certificate_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                                                View
                                            </button>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <strong>GST Certificate:</strong>
                                            <input type="file" class="form-control" name="gst_certificate_path" placeholder="Choose files">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-1 mt-4">
                                        <div class="form-group">
                                            <strong>&nbsp;</strong>
                                            @if($ChannelPartner->gst_certificate_path != '')

                                            <button data="{{ asset($ChannelPartner->gst_certificate_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                                                View
                                            </button>

                                            @endif
                                        </div>
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
    <title>Edit Channel Partner Form</title>


</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left col-lg-5">
                    <h2>Edit Channel Partner</h2>
                </div>
                <div class="pull-right col-lg-6" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('ChannelPartner.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('ChannelPartner.update',$ChannelPartner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Channel Partner Name:</strong>
                        <input type="text" name="cp_name" class="form-control" placeholder="Channel Partner Name" value="{{ $ChannelPartner->cp_name }}">
                        @error('cp_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email ID:</strong>
                        <input type="email" name="email_id" class="form-control" placeholder="Email ID" value="{{ $ChannelPartner->email_id }}">
                        @error('email_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Mobile:</strong>
                        <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="{{ $ChannelPartner->mobile }}">
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Address:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $ChannelPartner->address }}">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Projects:</strong>

                        <select class="form-control" id="projects" name="projects[]" multiple>
                            @php
                            $projects = explode(',',$ChannelPartner->projects);
                            @endphp
                            @foreach($all_projects as $value)
                            <option value="{{ $value['id'] }}" {{ (in_array($value['id'],$project_array)) ? 'selected' : '' }}>{{ $value['project_name'] }} </option>
                            @endforeach
                        </select>

                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Campany Name:</strong>
                        <input type="text" name="campany_name" class="form-control" placeholder="Campany Name" value="{{ $ChannelPartner->campany_name }}">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Campany Address:</strong>
                        <input type="text" name="company_address" class="form-control" placeholder="Campany Address" value="{{ $ChannelPartner->company_address }}">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>GST No.:</strong>
                        <input type="text" name="gstno" class="form-control" placeholder="GST No." value="{{ $ChannelPartner->gstno }}">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Rera No.:</strong>
                        <input type="text" name="rerano" class="form-control" placeholder="Rera No." value="{{ $ChannelPartner->rerano }}">
                        @error('rerano')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>A/C No.:</strong>
                        <input type="text" name="acc_no" class="form-control" placeholder="A/C No." value="{{ $ChannelPartner->acc_no }}">
                        @error('acc_no')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>IFSC:</strong>
                        <input type="text" name="ifsc" class="form-control" placeholder="IFSC" value="{{ $ChannelPartner->ifsc }}">
                        @error('ifsc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>CP ID:</strong>
                        <input type="text" name="cp_id" class="form-control" placeholder="CP ID" value="{{ $ChannelPartner->cp_id }}">
                        @error('cp_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-3">
                    <div class="form-group">
                        <strong>Rera Certificate:</strong>
                        <input type="file" class="form-control" name="rera_certificate_path" placeholder="Choose files">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="    margin-left: 300px;">

                        @if($ChannelPartner->rera_certificate_path != '')

                        <button data="{{ asset($ChannelPartner->rera_certificate_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                            View
                        </button>

                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-3">
                    <div class="form-group">
                        <strong>GST Certificate:</strong>
                        <input type="file" class="form-control" name="gst_certificate_path" placeholder="Choose files">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="    margin-left: 300px;">

                        @if($ChannelPartner->gst_certificate_path != '')

                        <button data="{{ asset($ChannelPartner->gst_certificate_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                            View
                        </button>

                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    @if(Auth::user()->role_id == "1")
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                </div>
            </div>
        </form>
    </div> 

    
</body>-->


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Docs</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- <iframe class="d-block w-100" src="{{ asset('projects/House of hiranandani/ReraCertificate/1661755936.pdf') }}" alt="First slide" style="height: 500px;"></iframe>
        <a href="" download>click here to download the PDF file.</a> -->
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div> -->

        </div>
    </div>
</div>
<!-- End of modal -->
<script>
    $(document).on('click', '.view', function() {
        var html = '';
        var path = $(this).attr('data');
        html += '<iframe class="d-block w-100" src="' + path + '" alt="First slide" style="height: 500px;"></iframe>';
        html += '<a href="' + path + '" download>click here to download the file.</a>';
        $(".modal-body").html(html);
        $("#myModal").modal("show");
    })
</script>