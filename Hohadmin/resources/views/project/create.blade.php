@include('header')

@if(!Auth::user()->hasPermission('add-project'))
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
                        <li class="breadcrumb-item"><a href="#">Add Project</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('project.index') }}" class=" btn btn-dark mb-2">Back</a>
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
                        <form id="AddProject" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Project Name:</strong>
                                            <input type="text" name="project_name" class="form-control" placeholder="Project Name">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12  col-md-6 mb-3 mt-1">
                                        <strong>Project Type:</strong>
                                        <div class="form-group">

                                            <select class="form-control select2" id="project_type_id" name="project_type_id">

                                                @foreach($all_project_types as $project_type)
                                                <option value="{{ $project_type->sub_type }}">{{ $project_type->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>About Project:</strong>
                                            <textarea name="about_project" class="form-control" placeholder="About Project"></textarea>
                                            @error('about_project')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Configuration:</strong>
                                            <select class="form-control select2" id="configuration" name="configuration[]" multiple>

                                                @foreach($all_configurations as $configuration)
                                                <option value="{{ $configuration->sub_type }}">{{ $configuration->sub_type }} </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Starting From Price:</strong>
                                            <input type="text" name="price" class="form-control" placeholder="Price">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>City:</strong>
                                            <select class="form-control select2" id="city" name="city_id">
                                                @foreach($all_cities as $value)
                                                <option value="{{ $value['id'] }}">{{ $value['city_name'] }} </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Carpet Area:</strong>
                                            <input type="text" name="carpet_area" class="form-control" placeholder="Carpet Area">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Connectivity:</strong>
                                            <textarea name="connectivity" class="form-control" placeholder="Connectivity"></textarea>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ameneties">
                                        <strong>Amenities:</strong>
                                        <div class="form-group">


                                            <select class="form-control select2" id="amenities" name="amenities_id[]" multiple="multiple">

                                                @foreach($all_amenities as $value)
                                                <option value="{{ $value->sub_type }}">{{ $value->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>No of Towers:</strong>
                                            <input type="text" name="no_of_towers" class="form-control" placeholder="No of Towers">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>No of Units:</strong>
                                            <input type="text" name="no_of_units" class="form-control" placeholder="No of units">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Possession Date:</strong>
                                            <input type="date" name="possession_date" class="form-control" placeholder="Possession Date">
                                            <input type="hidden" name="collateral_type" id="collateral_type">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Rera Certificate No.:</strong>
                                            <input type="text" name="rera_certificate_no" class="form-control" placeholder="Rera Certificate No">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Project Offers:</strong>
                                            <textarea name="project_offers" class="form-control" placeholder="Project Offers"></textarea>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                     <div class="col-xs-12 col-sm-12 col-md-6 mb-3 ">
                                        <div class="form-group">
                                            <strong>Campaign key:</strong>
                                            <input type="text" name="campaign_key" class="form-control" placeholder="Campaign key">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
				    <div class="col-xs-12 col-sm-12 col-md-6 ameneties">
                                        <strong>lead will be pushed to:</strong>
                                        <div class="form-group">


                                            <select class="form-control select2" id="integration" name="integrations">
						<option value="" selected>Select Integration</option>	
                                                @foreach($all_integration as $integration)
                                                <option value="{{ $integration->sub_type }}">{{ $integration->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                     <div class="col-xs-12 col-sm-12 col-md-6 ameneties">
                                        <strong>Lead Category:</strong>
                                        <div class="form-group">


                                            <select class="form-control select2" id="lead_category" name="lead_category">
						<option value="" selected>Select Lead Category </option>	
                                                @foreach($all_lead_category as $lead_category)
                                                <option value="{{ $lead_category->sub_type }}">{{ $lead_category->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-3">
                                        <div class="form-group">
                                            <strong>Rera Certificate:</strong>
                                            <input type="file" name="rera_certificate" placeholder="Choose files" class="form-control">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-3">
                                        <div class="form-group">
                                            <strong>Main Banner:</strong>
                                            <input type="file" name="hero_image" placeholder="Choose files" class="form-control">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 mb-3" style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
                                        <div class="row col-md-12">
                                            <div class="col-md-6">
                                                <strong>Add Collateral:</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary ml-3 mt-10" id="add_collateral"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>


                                        </div>


                                        <div class="append-colletaral">

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
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
    <title>Add Project Form</title>
</head>
<style>
    .scroll {
        height: 500px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    textarea.select2-search__field {
        width: 370px !important;
        height: 30px !important;
    }
</style>

<body>
    <div class="container-fluid nopadding mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left mb-2  col-lg-5">
                    <h2>Add Project</h2>
                </div>
                <div class="pull-right  col-lg-6" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('project.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>

        @endif
        <form id="AddProject" action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Project Name:</strong>
                        <input type="text" name="project_name" class="form-control" placeholder="Project Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12  col-md-6 mb-3 mt-1">
                    <strong>Project Type:</strong>
                    <div class="form-group">

                        <select class="form-control" id="project_type_id" name="project_type_id">

                            @foreach($all_project_types as $project_type)
                            <option value="{{ $project_type->sub_type }}">{{ $project_type->sub_type }} </option>
                            @endforeach
                        </select>

                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Configuration:</strong>
                        <select class="form-control" id="configuration" name="configuration[]" multiple>

                            @foreach($all_configurations as $configuration)
                                <option value="{{ $configuration->sub_type }}">{{ $configuration->sub_type }} </option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Starting From Price:</strong>
                        <input type="text" name="price" class="form-control" placeholder="Price">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>City:</strong>
                        <select class="form-control" id="city" name="city_id">
                            @foreach($all_cities as $value)
                            <option value="{{ $value['id'] }}">{{ $value['city_name'] }} </option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Carpet Area:</strong>
                        <input type="text" name="carpet_area" class="form-control" placeholder="Carpet Area">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Connectivity:</strong>
                        <textarea name="connectivity" class="form-control" placeholder="Connectivity"></textarea>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-1 ameneties">
                    <strong>Amenities:</strong>
                    <div class="form-group">


                        <select class="form-control amenities" id="amenities" name="amenities_id[]" multiple="multiple">

                            @foreach($all_amenities as $value)
                            <option value="{{ $value->sub_type }}">{{ $value->sub_type }} </option>
                            @endforeach
                        </select>

                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>No of Towers:</strong>
                        <input type="text" name="no_of_towers" class="form-control" placeholder="No of Towers">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>No of Units:</strong>
                        <input type="text" name="no_of_units" class="form-control" placeholder="No of units">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Possession Date:</strong>
                        <input type="date" name="possession_date" class="form-control" placeholder="Possession Date">
                        <input type="hidden" name="collateral_type" id="collateral_type">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Rera Certificate No.:</strong>
                        <input type="text" name="rera_certificate_no" class="form-control" placeholder="Rera Certificate No">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Project Offers:</strong>
                        <textarea name="project_offers" class="form-control" placeholder="Project Offers"></textarea>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3 mt-3">
                    <div class="form-group">
                        <strong>Rera Certificate:</strong>
                        <input type="file" name="rera_certificate" placeholder="Choose files" class="form-control">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <strong>Main Banner:</strong>
                        <input type="file" name="hero_image" placeholder="Choose files" class="form-control">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 mt-4 col-md-12 msg">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3" style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong>Add Colleteral:</strong>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary ml-3 mt-10" id="add_collateral"><i class="fa fa-add"></i></button>
                        </div>


                    </div>


                    <div class="append-colletaral">

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ml-3 mt-5">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body> -->
<script>
    $(document).ready(function() {
        // $(".amenities").select2({
        //     tags: true,
        //     theme: 'bootstrap5',
        //     placeholder: 'Select Amenities',
        // }).on('select2:select', function(e) {
        //     var el = $(this);
        // })

        // $("#configuration").select2({
        //     tags: true,
        //     theme: 'bootstrap5',
        //     placeholder: 'Select Configuration',
        // }).on('select2:select', function(e) {
        //     var el = $(this);
        // })

        // $("#project_type_id").select2({
        //     tags: true,
        //     theme: 'bootstrap5',
        //     placeholder: 'Select Project Type',
        // }).on('select2:select', function(e) {
        //     var el = $(this);
        // });

        // $('#amenities').multiselect({		
        //     nonSelectedText: 'Select Amenities'				
        // });

        $(document).on('click', '#add_collateral', function() {
            var html = '';
            var collateral_type = <?php echo $all_collaterals; ?>;

            html += '<div class="col-xs-12 col-sm-12 row mt-4 div-colleteral">'
            html += '<div class="col-md-5">';
            html += '<select class="form-control select2"  name="collateral_type">';

            $.each(collateral_type, function(arr, i) {
                html += '<option value="' + i.sub_type + '">' + i.sub_type + '</option>'
            })
            html += '</select>'
            html += '</div>'
            html += '<div class="col-md-5">';
            html += '<input type="file" name="collateral_image" placeholder="Choose files"  class="form-control" multiple>';
            html += '</div>'
            html += '<div class="col-md-2">';
            html += '<a class="delete-collateral"><i class="fa fa-trash"></i></a>';
            html += '</div>'
            html += '</div>';

            $(".append-colletaral").append(html);



        })
        $('#AddProject').submit(function(event) {
            event.preventDefault();
            url = $(this).attr("action");
            var collateral_array = [];
            var cnt = 0;
            var token = $("meta[name='csrf-token']").attr("content");

            $('.div-colleteral').each(function() {
                collateral_array.push($(this).find('select[name="collateral_type"]').val());
            })
            var CollateralArraySort = collateral_array.sort();

            var CollateralDuplicate = [];
            for (var i = 0; i < CollateralArraySort.length - 1; i++) {
                if (CollateralArraySort[i + 1] == CollateralArraySort[i]) {
                    CollateralDuplicate.push(CollateralArraySort[i]);
                }
            }

            //console.log(CollateralDuplicate);
            if (CollateralDuplicate.length > 0) {

                $(".msg").html('<span class="alert alert-danger">Duplicate collateral Types</span>');
                $(".msg").fadeIn();
                $(".msg").fadeOut();
                return false;
            }


            var formData = new FormData(this);
            formData.set('collateral_array', collateral_array.length);


            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data) {
                    // alert(data)
                    if (collateral_array.length > 0) {
                        $('.div-colleteral').each(function() {

                            var el = $(this);
                            var colformdata = new FormData();

                            let TotalFiles = el.find('input[type="file"]')[0].files.length; //Total files
                            let files = el.find('input[type="file"]')[0];
                            for (let i = 0; i < TotalFiles; i++) {
                                colformdata.append('files' + i, files.files[i]);
                            }
                            colformdata.set('project_id', data.last_inserted_id);
                            colformdata.set('project_name', data.project_name);
                            colformdata.set('collateral_name', el.find('select[name="collateral_type"] option:selected').text());
                            colformdata.set('TotalFiles', TotalFiles);
                            colformdata.set('collateral_type', el.find('select[name="collateral_type"]').val());
                            //colformdata.set('files',files);


                            colformdata.set('_token', token);
                            $.ajax({
                                url: 'https://houseofhiranandani-prioritycircle.in/Hohadmin/public/ProjectCollateral',
                                type: 'POST',
                                data: colformdata,
                                success: function(data) {
                                    window.location = data.redirect_url;
                                },
                                cache: false,
                                contentType: false,
                                processData: false


                            })
                        })
                    } else {
                        window.location.href = "../project/";
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });


        $(document).on('click', '.delete-collateral', function() {
            $(this).parent().parent().remove();
        });
    });
</script>