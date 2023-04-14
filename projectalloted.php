<!doctype html>
<?php
    include 'constant.php';
    session_start();
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
    font-family: "Roboto", sans-serif !important;
    overflow: hidden;
    background-repeat: no-repeat;
    background-position: center;
  }
  form#ProjectLeads {
    padding: 0;
}



.modal-content{
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 50%;
}
</style>
<form id="ProjectLeads" action="project_details.php" method="POST">
    <input type="hidden" name="project_id" id="project_id">
    
</form>
<body>
    <section id="third-main">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-6 col-9"><a href="homescreen.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a><span>Projects Alloted</span></div>
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

 <!-- Modal -->
<div class="modal fade" id="InactiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h3 class="modal-title" id="exampleModalnewLabel">Complete Your Profile</h3>    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">   
            <h1 style="text-align: center; margin-bottom: 10%;">Complete Your Profile</h1> 
            <div class="col-lg-12" style="text-align: center;"><img src="img/Complete-Profile.png" style="width: 40%;"></div>   
            <p style="margin-top: 10%; text-align: center; font-size: 20px;">Please complete your profile to unlock more benefits*</p>
            <div class="row col-12">
                <div class="col-5 offset-1"style="margin-top: 5px;"><a data-bs-dismiss="modal" aria-label="Close" style="color: #03a8ec;font-size: 16px;cursor: pointer;">I'll do it later.</a></div>
                <div class="col-4 offset-2"><a href="manageprofile.php" class="btn btn-primary" style="background: #7b1846;">Let's do it</a></div>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- ---------------------end cdc profile-------------------------- -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

 $('#loading').hide(); 
    
    $(document).ready(function () {
           

            mixpanel.track("Project List page", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Project List page",
                "ProjectName":'',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Project List page",
            });


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
                        html += '        <a id="project_list" data-project="' + i.project_name + '" data-id="' + i.id + '"><img src="img/icon.png" class="card-img-top" alt="..."><p>' + i.project_name + ', ' + i.city_name + '</p> </a>';
                        html += '    </div>';
                        html += '</div> ';

                    })

                    $('.project-list').html(html);
                }
            });


        }

        $(document).on('click','#project_list',function(){

            var id = $(this).data('id');
            var project_name = $(this).data('project');
            
          

            mixpanel.track("Click on Project", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Click on Project",
                "ProjectName":project_name,
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Click on Project",
            });


            $("#project_id").val(id);
            $("#ProjectLeads").submit();
        })
    })

    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

    if(lastPathSegment == 'projectalloted.php'){

        $("#homescreen p").attr('style','color:#fff');
        $("#collaterals p").attr('style','color:#fff');
        $("#projectalloted p").attr('style','color:#b9a479');
        $("#generateleads p").attr('style','color:#fff');
        $("#units_available p").attr('style','color:#fff');

        
        $("#homescreen_white").show();
        $("#homescreen_red").hide();

        $("#collaterals_white").show();
        $("#collaterals_red").hide();

        $("#projectalloted_white").hide();
        $("#projectalloted_red").show();

        $("#generateleads_white").show();
        $("#generateleads_red").hide();

        $("#units_available_white").show();
        $("#units_available_red").hide();
    }
</script>
</body>
</html>