@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Collaterals</title>
<!-- JS, Popper.js, and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb row"  style="margin-bottom: 35px;">
                <div class="pull-left col-lg-6">
                    <h2>Project Collateral</h2>
                </div>
                @if(Auth::user()->role_id == "1")
                <div class="pull-right mb-2 col-lg-6" style="text-align: right;">
                    <a class="btn btn-success" href="{{ route('ProjectCollateral.create') }}"> Create Project Collateral</a>
                </div>
                @endif
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Project Name</th>
                    <th>Collateral Type</th>
                    <th>View</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ProjectCollateral as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->project_name }}</td>
                        <td>{{ $value->collateral_name }}</td>
                        <td>
                             <a class="btn btn-primary" data-id="{{ $value->pathnames }}"  data-toggle="modal" data-target=".bd-example-modal-lg" id="image_slider">View</a> 
                        </td>
                        <td>
                            <form action="{{ route('ProjectCollateral.destroy',$value->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('ProjectCollateral.edit',$value->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
       
    </div>
</body>


<!-- Image Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="container" id="images">

        </div>
    </div>
  </div>
</div>

<script>
$(".alert-success p").fadeOut();
  $(document).on('click',"#image_slider",function(){

    var images = $(this).data('id').split(",");
    console.log(images);
        html= '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
  
        html+= '<div class="carousel-inner">';
        var cnt = 0;
        $.each(images,function(arr,i){
            cnt++;
            var active = '';

            if(cnt == '1'){
                active= 'active';
            }
            html+= '<div class="carousel-item '+active+'">';
            html+= '<img class="d-block w-100" src="'+i+'" alt="First slide" style="height: 500px;">';
            html+= '</div>';
        })
       
       
        html+= '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
        html+= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        html+= '<span class="sr-only">Previous</span>';
        html+= '</a>';
        html+= '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
        html+= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        html+= '<span class="sr-only">Next</span>';
        html+= '</a>';
        html+= '</div>';

        $("#images").html(html);
  })


  
  </script>
</html>
@endsection