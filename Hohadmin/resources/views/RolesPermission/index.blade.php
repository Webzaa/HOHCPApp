@include('header')
@if(!Auth::user()->hasPermission('view-roles-permission'))
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
                        <li class="breadcrumb-item"><a href="#">Roles and Permissions</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="alert alert-success msg col-12" style="display: none;">
                <p></p>
            </div>
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

                            <div class="col-auto">
                                <label for="proile" class="col-form-label">Roles</label>
                            </div>
                            <select class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;" id="roles">
                            <!-- <select class="form-select-sm col-4" aria-label="Default select example" id="roles"> -->
                                <option value="">Select Role</option>
                                @foreach ($all_Roles as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select> <br>
                            <button type="button" class="btn btn-light my-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; border: 1px solid #000;" id="select_all">
                                Select All
                            </button>
                            <button type="button" class="btn btn-light my-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; border: 1px solid #000" id="unselect_all">
                                Unselect All
                            </button>
                            @csrf
                            <div class="row append-permission">



                            </div>


                            <button type="button" class="btn btn-primary mt-3" id="submit">
                                Submit
                            </button>
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
        <title>Roles Permissions</title>
    </head>

    <body>
        <style>
            .form-check-input[type=checkbox] {
                border-radius: 2.25em;
            }
        </style>

        <div class="container">
            <div class="alert alert-success msg" style="display: none;">
                <p></p>
            </div>
            <div class="col-12" style="border: 1px solid #ccc; background-color: #ccc; 
        padding: 10px; margin-top: 20px; border-radius: 10px;">
                <h2>Roles</h2>
                
                <div class="col-auto">
                    <label for="proile" class="col-form-label">Roles</label>
                </div>
                <select class="form-select-sm col-4" aria-label="Default select example" id="roles">
                    <option value="">Select Role</option>
                    @foreach ($all_Roles as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select> <br>

                
                <button type="button" class="btn btn-light my-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; border: 1px solid #000;" id="select_all">
                    Select All
                </button>
                <button type="button" class="btn btn-light my-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; border: 1px solid #000" id="unselect_all">
                    Unselect All
                </button>

                <div class="row append-permission">



                </div>


                <button type="button" class="btn btn-primary mt-3" id="submit">
                    Submit
                </button>


            </div>
        </div>



    </body> -->
<script>
    $("#roles").select2({
        tags: true,
        theme: 'bootstrap5',
        placeholder: 'Select Roles',
    }).on('select2:select', function(e) {
        var el = $(this);
    })
    $(document).on('change', '#roles', function() {
        console.log($(this).val());
        GetPermissions($(this).val());
    })


    function GetPermissions(id) {

        $.ajax({
            type: "GET",
            url: 'get-permissions/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data);

                var html = '';

                $.each(data.all_Permissions, function(arr, i) {
                    html += '<div class="col-md-4">';
                    html += '    <div class="form-check">';
                    var checked = '';
                    if (i.permission_id != '') {
                        checked = 'checked';
                    }
                    html += '<input class="form-check-input" name="permissions" type="checkbox" value="' + i.id + '" id="' + i.slug + '" ' + checked + '>';
                    html += '<label class="form-check-label" for="' + i.slug + '">';
                    html += i.name;
                    html += '</label>';
                    html += '</div>';
                    html += '</div>';
                })

                $(".append-permission").html(html);

            }
        })
    }

    $(document).on('click', '#select_all', function() {
        $(".form-check-input").prop('checked', true);
    })

    $(document).on('click', '#unselect_all', function() {
        $(".form-check-input").prop('checked', false);
    })



    $(document).on('click', '#submit', function() {
        var permissions = [];
        $("input:checkbox[name=permissions]:checked").each(function() {
            permissions.push($(this).val());
        });
        var role_id = $("#roles").val();
        var token = $("input[name='_token']").val();

        //console.log(permissions);

        $.ajax({
            type: 'POST',
            url: "{{ route('StoreRolePermission.post') }}",
            data: {
                permissions: permissions,
                role_id: role_id,
                _token: token
            },
            success: function(data) {
                $(".msg").html('<p>Record added successfully.</p>');
                $(".msg").show();
                setTimeout(function() {
                    window.location.reload();
                }, 3000);
            }
        });
    })
</script>