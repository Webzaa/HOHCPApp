<!doctype html>
<?php
    session_start();
    include 'constant.php';
    if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){
        header('Location: index.php');
    }
?>



<?php  include 'header.php'; ?>

<style>
    body {
    /*padding: 30px 0px 30px 0px;*/
    /* background-image: url(../img/whitebgh.jpg); */
    background-image: url(./img/whitebgh.jpg);
    background-size: initial;
    /* padding-bottom: 28px; */
    height: 100vh;
    overflow: hidden;
    background-repeat: no-repeat;
    background-position: center;
  }
  form#ProjectLeads {
    padding: 0;
}
</style>
<form id="ProjectLeads" action="project_collateral.php" method="POST">
    <input type="hidden" name="project_id" id="project_id">
    
</form>
<body>
    <section id="third-main">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-6 col-9"><a href="homescreen.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a><span>Download Collateral</span></div>
                <div class="col-lg-6 col-3"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>
            </div>
        </div>
    </section>

    <section id="project-list-main">
        <div class="project-list-maininner">
            <div class="container">
                <div class="row">
                    <h2 class="head-pagefifth">Projects</h2>
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


            mixpanel.track("Project List Collateral", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Project List Collateral",
                "ProjectName":'',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Project List Collateral",
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

            mixpanel.track("Click on project Collateral", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Click on project Collateral",
                "ProjectName":project_name,
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Click on project Collateral",
            });
           
            $("#project_id").val(id);
            $("#ProjectLeads").submit();
        })
    })

    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

    if(lastPathSegment == 'collaterals.php'){

        $("#homescreen p").attr('style','color:#fff');
        $("#collaterals p").attr('style','color:#b9a479');
        $("#projectalloted p").attr('style','color:#fff');
        $("#generateleads p").attr('style','color:#fff');
        $("#units_available p").attr('style','color:#fff');

        
        $("#homescreen_white").show();
        $("#homescreen_red").hide();

        $("#collaterals_white").hide();
        $("#collaterals_red").show();

        $("#projectalloted_white").show();
        $("#projectalloted_red").hide();

        $("#generateleads_white").show();
        $("#generateleads_red").hide();

        $("#units_available_white").show();
        $("#units_available_red").hide();
    }
</script>
</body>
</html>