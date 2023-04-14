<!doctype html>
<?php
    session_start();
    include 'constant.php';
    if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){
        header('Location: index.php');
    }
?>

<!-- <html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOH Mobile App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/responsive1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head> -->

<?php  include 'header.php'; ?>

<style>
    body {
    /*padding: 30px 0px 30px 0px;*/
    /* background-image: url(../img/whitebgh.jpg); */
    background-image: url(./img/whitebgh.jpg);
    background-size: initial;
    /* padding-bottom: 28px; */
    height: 100vh;
    overflow: inherit;
    background-repeat: no-repeat;
    background-position: center;
  }
  form#ProjectUnits {
    padding: 0;
}
</style>
<form id="ProjectUnits" action="project_units.php" method="POST">
    <input type="hidden" name="Pid" id="Pid">
    
</form>
<body>
    <section id="third-main">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-6 col-9"><a href="homescreen.php"><img src="img/lessthanarrow.png" class="singlearrow"></a><span>Projects Alloted(Unit Details)</span></div>
                <div class="col-lg-6 col-3"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>
            </div>
        </div>
    </section>

    <section id="project-list-main">
        <div class="project-list-maininner">
            <div class="container">
                <div class="row">
                    <h2 class="head-pagefifth">Projects List</h2>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4 mt-1 project-list">
                    
                    
                        
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

 $('#loading').hide(); 
    
    $(document).ready(function () {


        GetProjects()

        function GetProjects() {
            var fd = new FormData();

            fd.append('token', '<?php echo $_COOKIE['token'] ?>');
            fd.append('email', '<?php echo $_COOKIE['username'] ?>');

            console.log(fd)

            $.ajax({
                url: '<?php echo APIURL; ?>api/GetProjects',
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    var html = '';

                    $.each(data.project, function (arr, i) {
                        html += '<div class="col-4">';
                        html += '   <div class="card card-img-top-main">';
                        html += '        <a id="project_list" data-id="' + i.Pid + '"><img src="img/icon.png" class="card-img-top" alt="..."><p>' + i.project_name + ', ' + i.city_name + '</p> </a>';
                        html += '    </div>';
                        html += '</div> ';

                    })

                    $('.project-list').html(html);
                }
            });


        }

        $(document).on('click','#project_list',function(){
            var id = $(this).data('id');
            $("#Pid").val(id);
            $("#ProjectUnits").submit();
        })


    })

    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
    if(lastPathSegment == 'units_available.php'){

        $("#homescreen p").attr('style','color:#fff');
        $("#collaterals p").attr('style','color:#fff');
        $("#projectalloted p").attr('style','color:#fff');
        $("#generateleads p").attr('style','color:#fff');
        $("#units_available p").attr('style','color:#b9a479');
        
            $("#homescreen_white").show();
            $("#homescreen_red").hide();

            $("#collaterals_white").show();
            $("#collaterals_red").hide();

            $("#projectalloted_white").show();
            $("#projectalloted_red").hide();

            $("#generateleads_white").show();
            $("#generateleads_red").hide();

            $("#units_available_white").hide();
            $("#units_available_red").show();
        }
</script>
</body>
</html>