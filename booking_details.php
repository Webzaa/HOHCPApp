<!doctype html>

<?php

  session_start();


include 'constant.php';
  //print_r($_COOKIE);exit;

  if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

      header('Location: index.php');

  }





?>



<?php  include 'header.php'; ?>



<style>

  body {

    background-image: none;

  }

  section#leads-table th {

    background-color: #f1f1f1 !important;

  }



  table.leadtable {

    width: 100%;

    text-align: center;

  }



  i.fa-solid.fa-angle-down {

    color: #941f53;

  }





  table.table.table-condensed {

    width: 100% !important;

    text-align: center;

}

button.btn.btn-success.exploder {

    background-color: transparent;

    color: #941f53;

    border: none;

}



table.table.table-condensed.table-inner th {

color: #000;

background-color: #fff !important;

}

table.table.table-condensed.table-inner th {

    color: #000;

    background-color: #fff !important;

    font-size: 12px;

    border: none;

}

table.table.table-condensed.table-inner td {

  font-size: 12px;

}

table.table.table-condensed th {

    color: #941f53;

    background-color: #f1f1f1 !important;

}



/* The popup form - hidden by default */

.form-popup {

    display: none;

    position: fixed;

    bottom: 0;

    right: 0px;

    border: 1px solid #444;

    z-index: 9;

    background-color: #fff;

    width: 100%;

    padding: 20px 30px 30px;

}

i.fa-solid.fa-filter {

    position: absolute;

    right: 0;

    top: 35px;

}

.filterhead {

  font-size: 16px;

}

.filterhead-inner {

  font-size: 14px;

}

label.form-check-label {

    font-size: 13px;

    font-weight: 600;

}

.form-check-input:checked[type=radio] {

    padding: 8px;

}

.form-check-input[type=radio] {

    border-radius: 50%;

    padding: 6px;

}

button.btn.clear-filter {

    border: 1px solid #000;

    padding: 2px 40px;

    border-radius: 20px;

}

button.btn.add-apply {

  border: 1px solid #941f53;

    padding: 2px 60px;

    border-radius: 20px;

    color: #fff;

    background-color: #941f53;

}

button.btn.exploder.btn-danger:active {

    color: #941f53;

    background-color: transparent;

    border: none;

}



button.btn.exploder.btn-danger:hover{

   color: #941f53;

    background-color: transparent;

    border: none;

}



.btn-danger {

    --bs-btn-color: #771744;

    --bs-btn-bg: transparent;

    --bs-btn-border-color: transparent;

    --bs-btn-hover-color: #fff;

    --bs-btn-hover-bg: transparent;

    --bs-btn-hover-border-color: transparent;

    --bs-btn-focus-shadow-rgb: 225,83,97;

    --bs-btn-active-color: #fff;

    --bs-btn-active-bg: transparent;

    --bs-btn-active-border-color: transparent;

    --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125);

    --bs-btn-disabled-color: #fff;

    --bs-btn-disabled-bg: transparent;

    --bs-btn-disabled-border-color: transparent;

}



.btn:hover {

    color: #721641;

    background-color: #bb2d3b00;

    border-color: #b02a3700;

}



</style>



<!-- section first start -->

<section id="third-main">

  <div class="container">

    <div class="row d-flex justify-content-between">

      <div class="col-lg-6 col-6"><a href="homescreen.php"><img src="img/lessthanarrow.png" class="singlearrow"></a><span>Booking           Status</span></div>

      <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

    </div>

  </div>

</section>

<!-- section first end -->



<section id="dropdown-page6">

  <div class="container">

    <form autocomplete="off" id="action_page.php">

      <div class="autocomplete col-lg-6 col-10 offset-1">

        <div class="d-flex justify-content-between">

          <h2 class="headpagesix">Booking Status</h2>

          <!-- <button class="open-button" onclick="openForm()">Open Form</button> -->

          <i class="fa-solid fa-filter" onclick="openForm()"></i>

        </div>



        <!-- form start -->

        <div class="form-popup col-md-12" id="myForm">

            <div class="d-flex justify-content-between">

              <h1 class="filterhead"><strong>Filter Order</strong></h1>

              <button type="button" class="btn cancel" onclick="closeForm()">x</button>

            </div>



            <div class="status-checked">

            <h1 class="filterhead-inner"><strong>Status</strong></h1>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault01" value="Y">

              <label class="form-check-label" for="flexRadioDefault01">

                Approved

              </label>

            </div>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault02" value="N">

              <label class="form-check-label" for="flexRadioDefault02">

                Pending

              </label>

            </div>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault02" checked value="All">

              <label class="form-check-label" for="flexRadioDefault02">

                All

              </label>

            </div>

          </div>



               <hr>

               <div class="time-checked">

               <h1 class="filterhead-inner"><strong>Time</strong></h1>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault1" checked value="anytime">

                 <label class="form-check-label" for="flexRadioDefault1">

                   Anytime

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault2" value="last_7_days">

                 <label class="form-check-label" for="flexRadioDefault2">

                   Last 7 days

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault3" value="last_30_days">

                 <label class="form-check-label" for="flexRadioDefault3">

                  Last 30 days

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault4" value="last_6_months">

                 <label class="form-check-label" for="flexRadioDefault24">

                  Last 6 Months

                 </label>

               </div>

              </div>

              <br>

              <button type="button" class="btn clear-filter">Clear Filter</button>

              <button type="button" class="btn add-apply" id="apply">Apply</button>

        </div>

      </form>



        <!-- form end -->

        

        <input id="project" type="text" name="projects" placeholder="Search for Leads">

      </div>

  </div>

</section>



<!-- table start -->

<div class="container first-container col-sm-12 pull-left">    

  <table class="table table-condensed">

    <thead>

      <tr>

        <th>Project Name</th>

        <th>Unit Wing</th>

        <th>Unit Name</th>

        <th>Booked Date</th>

      </tr>

    </thead>

    <tbody class="booking-data">



      

    </tbody>

  </table>

</div>

<!-- table end -->





























<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>





<script>

   $('#loading').hide(); 

  function openForm() {

    document.getElementById("myForm").style.display = "block";

  }

  

  function closeForm() {

    document.getElementById("myForm").style.display = "none";

  }

  </script>



<script>

$(document).on('click',".exploder",function(){

  $(this).toggleClass("btn-success btn-danger");

  $(this).children("span").toggleClass("glyphicon-search glyphicon-zoom-out");  



  $(this).closest("tr").next("tr").toggleClass("hide");

  

  if($(this).closest("tr").next("tr").hasClass("hide")){

    $(this).closest("tr").next("tr").children("td").slideUp();

  }

  else{

    $(this).closest("tr").next("tr").children("td").slideDown(350);

  }

});

</script>





<script>



  $(document).ready(function () {



    $(document).on('click','#apply',function(){

        GetLeads('')

    })

    GetLeads('');



    let lead = [];

    

    $("#project").autocomplete({

      source: lead,

      select: function(event, ui) {

        console.log(ui.item);

        GetLeads(ui.item.id);

      }

    });

    function GetLeads(id) {

      var fd = new FormData();

      var status =  $('input[name="status"]:checked').val();

      var time_filter =  $('input[name="time_filter"]:checked').val();

      

      fd.append('token', '<?php echo $_COOKIE['token'] ?>');

      fd.append('username', '<?php echo $_COOKIE['username'] ?>');

      fd.append('status', status);

      fd.append('time_filter', time_filter);

      fd.append('id', id);









      $.ajax({

        url: '<?php echo APIURL; ?>api/GetBookings',

        data: fd,

        processData: false,

        contentType: false,

        type: 'POST',

        success: function (data) {

          console.log(data);  

          var html = '';

           

          if(data.BookingData.length > 0){

             $.each(data.BookingData, function (arr, i) {



              



              

            

                  html += '  <tr>'

                  html += '    <td>'+i.project_name+'</td>';                

                  html += '    <td>'+i.unit_wing+'</td>';

                  html += '    <td>'+i.unit_name+'</td>';

                  html += '    <td>'+i.booked_date+'</td>';

                  html += '  </tr>';

               

             })

           }

           else{

                html += '<tr class="sub-container">';

                html += '<td>No record found.</td>';

                html += '</tr>';

           }



           $(".booking-data").html(html);

           console.log(lead);

        }

      });

    }

  })

</script>



</body>



</html>

