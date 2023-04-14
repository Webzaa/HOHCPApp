@include('header')


@if(!Auth::user()->hasPermission('edit-project'))
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
                        <li class="breadcrumb-item"><a href="#">Project Edit</a></li>
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
                        <form id="AddProject" action="{{ route('project.update',$project->id) }}" class="scroll" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Project Name:</strong>
                                            <input type="text" name="project_name" class="form-control" placeholder="Project Name" value="{{ $project->project_name }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>About Project:</strong>
                                            <textarea name="about_project" class="form-control" placeholder="About Project">{{ $project->about_project }}</textarea>
                                            @error('about_project')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12  col-md-6">
                                        <strong>Project Type:</strong>
                                        <div class="form-group">

                                            <select class="form-control select2" id="project_type_id" name="project_type_id">

                                                @foreach($all_project_types as $project_type)
                                                <option value="{{ $project_type->sub_type }}" {{ ($project_type->sub_type == $project->project_type_id)  ? 'selected' : '' }}>{{ $project_type->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Configuration:</strong>
                                            @php $configuration = array(); @endphp
                                            @if($project->configuration != '')
                                            @php
                                            $configurations = explode(',',$project->configuration);

                                            @endphp
                                            @endif
                                            <select class="form-control select2" id="configuration" name="configuration[]" multiple>
                                                @foreach($all_configurations as $configuration)
                                                <option value="{{ $configuration->sub_type }}" {{ (in_array($configuration->sub_type, $configurations)) ? 'selected' :''; }}>{{ $configuration->sub_type }} </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Starting From Price:</strong>
                                            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $project->price }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>City:</strong>
                                            <select class="form-control select2" id="city" name="city_id">
                                                @foreach($all_cities as $value)
                                                <option value="{{ $value['id'] }}" {{ $value['id'] == $project->city_id ? 'selected' : '' }}>{{ $value['city_name'] }} </option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Carpet Area:</strong>
                                            <input type="text" name="carpet_area" class="form-control" placeholder="Carpet Area" value="{{ $project->carpet_area }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Connectivity:</strong>
                                            <textarea name="connectivity" class="form-control" placeholder="Connectivity"> {{ $project->connectivity }}</textarea>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 ameneties">
                                        <strong>Amenities:</strong>
                                        <div class="form-group">


                                            <select class="form-control amenities select2" id="amenities" name="amenities_id[]" multiple>
                                                @php $amenities = array(); @endphp
                                                @if($project->amenities_id != '')
                                                @php
                                                $amenities = explode(',',$project->amenities_id);

                                                @endphp
                                                @endif
                                                @foreach($all_amenities as $amenity)
                                                <option value="{{ $amenity->sub_type }}" {{ (in_array($amenity->sub_type, $amenities)) ? 'selected' :''; }}>{{ $amenity->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>No of Towers:</strong>
                                            <input type="text" name="no_of_towers" class="form-control" placeholder="No of Towers" value="{{ $project->no_of_towers }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>No of Units:</strong>
                                            <input type="text" name="no_of_units" class="form-control" placeholder="No of units" value="{{ $project->no_of_units }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Possession Date:</strong>
                                            <input type="date" name="possession_date" class="form-control" placeholder="Possession Date" value="{{ $project->possession_date }}">
                                            <input type="hidden" name="collateral_type" id="collateral_type">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Rera Certificate No.:</strong>
                                            <input type="text" name="rera_certificate_no" class="form-control" placeholder="Rera Certificate No" value="{{ $project->rera_certificate_no }}">
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Project Offers:</strong>
                                            <textarea name="project_offers" class="form-control" placeholder="Project Offers">{{ $project->project_offers }}</textarea>
                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <strong>Campaign key:</strong>
                                            <input type="text" name="campaign_key" class="form-control" placeholder="Campaign key" value="{{ $project->campaign_key }}">
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
                                                <option value="{{ $integration->sub_type }}" {{ ($integration->sub_type == $project->integrations)  ? 'selected' : '' }}>{{ $integration->sub_type }} </option>
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
                                                <option value="{{ $lead_category->sub_type }}" {{ ($lead_category->sub_type == $project->lead_category)  ? 'selected' : '' }}>{{ $lead_category->sub_type }} </option>
                                                @endforeach
                                            </select>

                                            @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <strong>Rera Certificate:</strong>
                                            <input type="file" name="rera_certificate" placeholder="Choose files" class="form-control">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 mt-4">

                                        @if($project->rera_certificate_path != '')

                                        <button data="{{ asset($project->rera_certificate_path) }}" type="button" class="btn btn-primary view">
                                            View
                                        </button>

                                        @endif
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Main Banner:</strong>
                                            <input type="file" name="hero_image" placeholder="Choose files" class="form-control">
                                            @error('files')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 mt-4">

                                        @if($project->hero_image_path != '')

                                        <button data="{{ asset($project->hero_image_path) }}" type="button" class="btn btn-primary view">
                                            View
                                        </button>

                                        @endif
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12" style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
                                        <div class="row col-md-12">
                                            <div class="col-md-6">
                                                <strong>Add Collateral:</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary ml-3 mt-10" id="add_collateral"><i class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="mb-2 mt-4 col-md-12 msg">

                                            </div>


                                        </div>

                                        <div class="append-colletaral">


                                            @foreach ($project_collateral as $project_collateral_value)

                                            <div class="col-xs-12 col-sm-12 row mt-4 div-show-colleteral">
                                                <div class="col-md-5">
                                                    <select class="form-control select2" name="collateral_type" disabled style="border: none;background-color: #f2f2f2;">';
                                                        @foreach ($all_collaterals as $all_collaterals_value)
                                                        <option value="{{ $all_collaterals_value->sub_type }}" {{ ($project_collateral_value->collateral_type == $all_collaterals_value->sub_type) ? 'selected':''; }}>{{ $all_collaterals_value->sub_type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2">

                                                    @if($project_collateral_value->pathnames != '')
                                                    <a class="view-collateral" data-id="{{ $project_collateral_value->pathnames }}" data-toggle="modal" data-target=".bd-example-modal-lg" id="image_slider"><i class="fa fa-eye"></i></a>
                                                    @endif
                                                    <a class="delete-collateral" data-id="{{ $project_collateral_value->id }}"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>





                                    <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
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
    <title>Edit Project Form</title>
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
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row">
                <div class="pull-left col-md-6">
                    <h2>Edit Project</h2>
                </div>
                <div class="pull-right  col-lg-6" style="text-align: right;">
                    <a class="btn btn-primary" href="{{ route('project.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form id="AddProject" action="{{ route('project.update',$project->id) }}" class="scroll" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Project Name:</strong>
                        <input type="text" name="project_name" class="form-control" placeholder="Project Name" value="{{ $project->project_name }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12  col-md-5 mt-1">
                    <strong>Project Type:</strong>
                    <div class="form-group">

                        <select class="form-control" id="project_type_id" name="project_type_id">

                            @foreach($all_project_types as $project_type)
                                <option value="{{ $project_type->sub_type }}" {{ ($project_type->sub_type == $project->project_type_id)  ? 'selected' : '' }}>{{ $project_type->sub_type }} </option>
                            @endforeach
                        </select>

                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Configuration:</strong>
                        @php $configuration = array(); @endphp
                        @if($project->configuration != '')
                            @php
                                $configurations = explode(',',$project->configuration);
                                
                            @endphp
                        @endif
                        <select class="form-control" id="configuration" name="configuration[]" multiple>
                            @foreach($all_configurations as $configuration)
                                    <option value="{{ $configuration->sub_type }}" {{ (in_array($configuration->sub_type, $configurations)) ? 'selected' :''; }}>{{ $configuration->sub_type }} </option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Starting From Price:</strong>
                        <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $project->price }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>City:</strong>
                        <select class="form-control" id="city" name="city_id">
                            @foreach($all_cities as $value)
                            <option value="{{ $value['id'] }}" {{ $value['id'] == $project->city_id ? 'selected' : '' }}>{{ $value['city_name'] }} </option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Carpet Area:</strong>
                        <input type="text" name="carpet_area" class="form-control" placeholder="Carpet Area" value="{{ $project->carpet_area }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Connectivity:</strong>
                        <textarea name="connectivity" class="form-control" placeholder="Connectivity"> {{ $project->connectivity }}</textarea>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 mt-1 ameneties">
                    <strong>Amenities:</strong>
                    <div class="form-group">


                        <select class="form-control amenities" id="amenities" name="amenities_id[]" multiple>
                            @php $amenities = array(); @endphp
                            @if($project->amenities_id != '')
                            @php
                            $amenities = explode(',',$project->amenities_id);

                            @endphp
                            @endif
                            @foreach($all_amenities as $amenity)
                            <option value="{{ $amenity->sub_type }}" {{ (in_array($amenity->sub_type, $amenities)) ? 'selected' :''; }}>{{ $amenity->sub_type }} </option>
                            @endforeach
                        </select>

                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>No of Towers:</strong>
                        <input type="text" name="no_of_towers" class="form-control" placeholder="No of Towers" value="{{ $project->no_of_towers }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>No of Units:</strong>
                        <input type="text" name="no_of_units" class="form-control" placeholder="No of units" value="{{ $project->no_of_units }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Possession Date:</strong>
                        <input type="date" name="possession_date" class="form-control" placeholder="Possession Date" value="{{ $project->possession_date }}">
                        <input type="hidden" name="collateral_type" id="collateral_type">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Rera Certificate No.:</strong>
                        <input type="text" name="rera_certificate_no" class="form-control" placeholder="Rera Certificate No" value="{{ $project->rera_certificate_no }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Project Offers:</strong>
                        <textarea name="project_offers" class="form-control" placeholder="Project Offers">{{ $project->project_offers }}</textarea>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5 mt-2">
                    <div class="form-group">
                        <strong>Rera Certificate:</strong>
                        <input type="file" name="rera_certificate" placeholder="Choose files" class="form-control">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 mt-4">

                    @if($project->rera_certificate_path != '')

                    <button data="{{ asset($project->rera_certificate_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                        View
                    </button>

                    @endif
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>Main Banner:</strong>
                        <input type="file" name="hero_image" placeholder="Choose files" class="form-control">
                        @error('files')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 mt-4">

                    @if($project->hero_image_path != '')

                    <button data="{{ asset($project->hero_image_path) }}" type="button" class="btn btn-primary view" data-bs-toggle="modal" data-bs-target="#myModal">
                        View
                    </button>

                    @endif
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12" style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong>Add Colleteral:</strong>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary ml-3 mt-10" id="add_collateral"><i class="fa fa-add"></i></button>
                        </div>
                        <div class="mb-2 mt-4 col-md-12 msg">

                        </div>


                    </div>

                    <div class="append-colletaral">


                        @foreach ($project_collateral as $project_collateral_value)

                        <div class="col-xs-12 col-sm-12 row mt-4 div-show-colleteral">
                            <div class="col-md-5">
                                <select class="form-control" name="collateral_type" disabled style="border: none;background-color: #f2f2f2;">';
                                    @foreach ($all_collaterals as $all_collaterals_value)
                                    <option value="{{ $all_collaterals_value->sub_type }}" {{ ($project_collateral_value->collateral_type == $all_collaterals_value->sub_type) ? 'selected':''; }}>{{ $all_collaterals_value->sub_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">

                                @if($project_collateral_value->pathnames != '')
                                <a class="view-collateral" data-id="{{ $project_collateral_value->pathnames }}" data-toggle="modal" data-target=".bd-example-modal-lg" id="image_slider"><i class="fa fa-eye"></i></a>
                                @endif
                                <a class="delete-collateral" data-id="{{ $project_collateral_value->id }}"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>





                <button type="submit" class="btn btn-primary ml-3 col-lg-2">Submit</button>
            </div>
        </form>
    </div>
</body> -->


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Collateral Images</h4>
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

<!-- Image Modal -->
<div class="modal modal-xl fade bd-example-modal-lg colletaral-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <!-- <div class="modal-header">
        <h4 class="modal-title">Docs</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div> -->

            <div class="container" id="images">

            </div>
        </div>
    </div>
</div>
<!-- End of modal -->
<script>
    $(document).ready(function() {
        
        var cnt = 0;
        $(document).on('click', '#add_collateral', function() {
            var html = '';
            cnt++;
            var collateral_type = <?php echo $all_collaterals; ?>;

            html += '<div class="col-xs-12 col-sm-12 row mt-4 div-colleteral">'
            html += '<div class="col-md-5">';
            html += '<select class="form-control"  name="collateral_type" id="collateral_type">';

            $.each(collateral_type, function(arr, i) {
                html += '<option value="' + i.sub_type + '">' + i.sub_type + '</option>'
            })
            html += '</select>';
            html += '</div>';
            html += '<div class="col-md-5" id="image_collateral">';
            html += '<input type="file" name="collateral_image" placeholder="Choose files"  class="form-control" multiple>';
            html += '</div>';
            
            html += '<div class="col-md-5" id="CDC_collateral" style="display:none;">';
            html += '<input type="text" name="title" placeholder="Title"  class="form-control" multiple style="width: 27% !important;">';
            html += '<textarea id="msg_body" name="msg_body" rows="4" cols="50" class="form-control" style="width: 71% !important;float: right;position: relative;top: -35px;"></textarea>';
            html += '</div>';
            
            html += '<div class="col-md-2">';
            html += '<a class="delete-collateral" data-id="0"><i class="fa fa-trash"></i></a>';
            html += '</div>'
            html += '</div>';

            $(".append-colletaral").append(html);



        });
        
        $(document).on('change','#collateral_type',function(){
            
            if($(this).val() == 'WhatsApp' || $(this).val() == 'SMS Script' || $(this).val() == 'Videos'){
                
                
                 $(this).parent().next().next("#CDC_collateral").show();
                 $(this).parent().next("#image_collateral").hide();
                //  $("#CDC_collateral").show();
                // $("#image_collateral").hide();
                
                
                
            }
            else{
                
                $(this).parent().next().next("#CDC_collateral").hide();
                 $(this).parent().next("#image_collateral").show();
                // $("#CDC_collateral").hide();
                // $("#image_collateral").show();
            }
            
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

            // Adding Duplicate value in array
            var CollateralDuplicate = [];
            for (var i = 0; i < CollateralArraySort.length - 1; i++) {
                if (CollateralArraySort[i + 1] == CollateralArraySort[i]) {
                    CollateralDuplicate.push(CollateralArraySort[i]);
                }
            }

            // checking for duplicate values.
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
                    //console.log(data);return false;
                    if (collateral_array.length > 0) {
                        $('.div-colleteral').each(function() {

                            var el = $(this);
                            var colformdata = new FormData();

                            let TotalFiles = el.find('input[type="file"]')[0].files.length; //Total files
                            let files = el.find('input[type="file"]')[0];
                            var token =$('input[name=_token]').val();
                            //console.log(token);
                            colformdata.set('_token', token);
                            if(TotalFiles > 0){
                                for (let i = 0; i < TotalFiles; i++) {
                                    colformdata.append('files' + i, files.files[i]);
                                }
                            }else{
                                  colformdata.set('title', el.find('input[name="title"]').val()); 
                                  colformdata.set('msg_body', el.find('textarea[name="msg_body"]').val());   
                            }
                            colformdata.set('project_id', data.last_inserted_id);
                            colformdata.set('project_name', data.project_name);
                            colformdata.set('collateral_name', el.find('select[name="collateral_type"] option:selected').text());
                            colformdata.set('TotalFiles', TotalFiles);
                            colformdata.set('collateral_type', el.find('select[name="collateral_type"]').val());
                            //colformdata.set('files',files);

                            
                            $.ajax({
                                url: 'https://cpapp.houseofhiranandani.com/Hohadmin/public/ProjectCollateral',
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

                        window.location = data.redirect_url;
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });



        $(document).on('click', '.delete-collateral', function() {

            var id = $(this).data('id');
            var el = $(this);
            var token =$('input[name=_token]').val();
            if (id > 0) {
                $.ajax({
                    url: "../../ProjectCollateraldDelete/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(data) {

                        if (data.success == 'Record deleted successfully!') {
                            console.log(data.success);
                            $(".msg").html('<span class="alert alert-success">Collateral Deleted Successfully.</span>');
                            $(".msg").fadeIn();
                            $(".msg").fadeOut();
                            el.parent().parent().remove();
                        }
                        //
                    }
                });
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(document).on('click', '.view', function() {
            var html = '';
            var path = $(this).attr('data');
            html += '<iframe class="d-block w-100" src="' + path + '" alt="First slide" style="height: 500px;"></iframe>';
            html += '<a href="' + path + '" download>click here to download the file.</a>';
            $(".modal-body").html(html);
            $("#myModal").modal("show");
        })

    });


    $(document).on('click', "#image_slider", function() {

        var images = $(this).data('id').split(",");
        console.log(images);
        html = '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';

        html += '<div class="carousel-inner">';
        var cnt = 0;
        $.each(images, function(arr, i) {
            cnt++;
            var active = '';

            if (cnt == '1') {
                active = 'active';
            }
            $imagepath = i.split("|");
            console.log(i);
            html += '<div class="carousel-item ' + active + '" style="position:relative;">';
            html += '<iframe class="d-block w-100" src="../../' + $imagepath[0] + '" alt="First slide" style="height: 500px;"></iframe>';
            html += '<a class="download-image" download href="../../' + $imagepath[0] + '" style="position:absolute;top: 5px;right:7%;z-index:999;background: #fff;padding: 0px 5px;"><i class="fa fa-download"></i></a>';
            //html+= '<a class="deleteRecord" data-id="'+$imagepath[1]+'" style="color:red;position:absolute;top: 5px;right:3%;z-index:999;background: #fff;padding: 0px 5px;"><i class="fa fa-trash"></i></i></a>';
            html += '</div>';
        })


        html += '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
        html += '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        html += '<span class="sr-only">Previous</span>';
        html += '</a>';
        html += '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
        html += '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        html += '<span class="sr-only">Next</span>';
        html += '</a>';
        html += '</div>';

        $("#images").html(html);
    })


    $(document).on('click', ".deleteRecord", function() {
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");

        console.log($(this).parent());

        // $.ajax(
        // {
        //     url: "../../CollateralImage/"+id,
        //     type: 'DELETE',
        //     data: {
        //         "id": id,
        //         "_token": token,
        //     },
        //     success: function (){
        //         console.log("it Works");
        //     }
        // });

    });
</script>