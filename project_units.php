<!doctype html>

<?php

  session_start();

  //print_r($_COOKIE);exit;

  if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

      header('Location: index.php');

  }


  if(!isset($_POST['Pid']) || $_POST['Pid'] == 0){
       header('Location: index.php');
  }

?>



<?php  include 'header.php'; ?>



<style>

  body {

    background-image: none;
    height: auto;
    margin-bottom: 100px;

  }

  section#leads-table th {

    background-color: #f1f1f1 !important;

  }

  span.alert.alert-success {
    position: absolute;
    top: 88%;
    padding:0px;
    left: 0;
    text-align: center;
    width: 100%
}



  table.leadtable {

    width: 100%;

    text-align: center;

  }

table {
  border: 1px solid black;
}
th, td {
  border: 1px solid black;
}
td {
  padding: 5px;
}

#pagination {
  width: 100%;
  text-align: center;
}

#pagination ul li {
  display: inline;
  margin-left: 10px;
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
right: 0px;
top: 13px;
    font-size: 25px;

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

.otp-form .otp-field {
  display: inline-block;
 width: 35px;
    height: 35px;
    font-size: 15px;
    line-height: 1px;
  text-align: center;
  border: none;
  border-bottom: 2px solid var(--bs-secondary);
  outline: none;
}

.otp-form .otp-field:focus {
  border-bottom-color: var(--bs-dark);
}

a i.fa-sharp.fa-solid.fa-plus {
    text-decoration: none;
    color: #000;
    font-weight: bold;
}




</style>



<!-- section first start -->

<section id="third-main">

  <div class="container">

    <div class="row d-flex justify-content-between">

      <div class="col-lg-6 col-6"><a href="units_available.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a><span>Unit Status</span></div>

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

          <h2 class="headpagesix">Unit Detail Status</h2>

          <!-- <button class="open-button" onclick="openForm()">Open Form</button> -->

          <!-- <i class="fa-solid fa-filter" onclick="openForm()">&nbsp;&nbsp;<a href="generateleads.php"><i class="fa-sharp fa-solid fa-plus"></i></a></i> -->


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

        

        <!-- <input id="project" type="text" name="projects" placeholder="Search for Leads"> -->

      </div>

  </div>

</section>



<!-- table start -->

<div class="container first-container col-sm-12 pull-left">    

  <table class="table table-condensed">

    <thead>

      <tr>

        <th>Unit Name</th>
        <th>Unit Wing</th>
        <th>Key Name</th>
        <th>Carpet Area</th>
        <th>Flat Status</th>

      </tr>

    </thead>

    <tbody class="unit-data">



      

    </tbody>

  </table>

</div>
<div id="pagination">
  
</div>

<!-- table end -->







<div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalnewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalnewLabel">OTP Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="card col-12 col-md-8 col-lg-7 p-4">
      <div class="card-body">
        <h4 class="card-title text-center">OTP Verificattion</h4>
        <div class="card-text text-center">
          <form action="" class="otp-form">
            <input class="otp-field" type="text" id="OTP_1" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_2" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_3" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_4" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_5" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_6" name="opt-field[]" maxlength=1>
            <input type="hidden" name="uniqueid" id="uniqueid">
            <input type="hidden" name="project_id" id="project_id">

            <!-- Store OTP Value -->
            <input class="otp-value" type="hidden" name="opt-value">
             <div class="msg"></div>
            <div class="d-block mt-4">
              <button class="btn btn-primary" type="submit" id="VerifyOTP">Verify</button>
            </div>
          </form>
        </div>
      </div>
    </div> 
      </div>
  
    </div>
  </div>
</div>





















<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://pagination.js.org/dist/2.5.0/pagination.js"></script>


<script type="text/javascript">

 $('#loading').hide(); 

</script>


<script>

  function openForm() {

    document.getElementById("myForm").style.display = "block";

  }

  

  function closeForm() {

    document.getElementById("myForm").style.display = "none";

  }

  </script>


<script>



  $(document).ready(function () {

    $(document).on('click','#apply',function(){
        GetUnits('');
    })

    GetUnits('');

    let lead = [];

    function GetUnits(id) {

      

      var fd =JSON.stringify({"api_key": "WEBZAA-25052022-HDIK7-DGDDT-UITQW","pid": '<?php echo $_POST["Pid"] ; ?>'});
      $.ajax({

        url: 'https://net4hoh.sperto.co.in/_api/api_auth_cp_list_units.php',

        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
        //type: 'POST',
        method: "POST",
        beforeSend:function(){
          $('#loading').show();
        },
        success: function (data) {

          //console.log(data);  
          $('#loading').hide();
          var html = '';

          

          if(data.status == "success"){

             $.each(data.data, function (arr, i) {              
                  var carpet_area = i.carpet_area.replace("Microsoft", "W3Schools");
                  html += '<tr>';      
                  html += '    <td>'+i.unit_name+'</td>';
                  html += '    <td>'+i.unit_wing+'</td>';
                  html += '    <td>'+i.key_name+'</td>';
                  html += '    <td>'+i.carpet_area+'</td>';
                  var flat_status = '';
                  if(i.flat_status == 'A'){
                      flat_status = 'Available';
                  }
                  else if(i.flat_status == 'B'){
                      flat_status = 'Booked';
                  }
                  else if(i.flat_status == 'L'){
                      flat_status = 'Blocked';
                  }
                  else if(i.flat_status == 'S'){
                      flat_status = 'Confirmed/Alloted';
                  }
                  else if(i.flat_status == 'R'){
                      flat_status = 'Refuge Area';
                  }
                  else if(i.flat_status == 'E'){
                      flat_status = 'Leased';
                  }


                  html += '    <td>'+flat_status+'</td>';
                  html += '</tr>';

             })

           }
           else{

                html += '<tr class="sub-container">';
                html += '<td colspan="5">No record found.</td>';
                html += '</tr>';

           }



            $(".unit-data").html(html);

            let rows = []
            $('table tbody tr').each(function(i, row) {
              return rows.push(row);
            });

            $('#pagination').pagination({
                dataSource: rows,
                pageSize: 10,
                callback: function(data, pagination) {
                    $('tbody').html(data);
                }
            })
           

        }

      });

    }


  })

</script>



</body>



</html>

