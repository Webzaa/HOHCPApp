<!doctype html>

<?php

  session_start();

  //print_r($_COOKIE);exit;

  if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

      header('Location: index.php');

  }

?>







<?php  include 'header.php'; ?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>

  body {

    background-image: url(./img/whitebg.jpg);

    background-repeat: no-repeat;

    background-position: center;

    height: 100vh;

    padding-bottom: 100px;

    margin: 0;

    background-size: cover;

    background-position: center;

    padding: 0;

    overflow: inherit;

  }

  .select2 {
    width: 100%!important; /* force fluid responsive */
    padding: 5px;
  }
  
  .select2-container {
    
    .select2-selection--single {
       height: 56px;
       position: relative;
      
      .select2-selection__rendered {
        line-height: 56px;
      }
    
      .select2-selection__arrow {
        top: 16px;
        right: 8px;
      }
  
      .select2-container--default {

        .select2-results>.select2-results__options {
          -webkit-overflow-scrolling: touch; /* use momentum scrolling */
        }
      }
    }      
  }
}
</style>

<form id="ProjectLeads" action="project_details.php" method="POST">

    <input type="hidden" name="project_id" id="project_id">

    

</form>

<!-- section first start -->

<section id="sixth-main">

  <div class="container">

    <div class="row d-flex justify-content-between">

      <div class="col-lg-6 col-6"><a href="homescreen.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a></div>

      <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

    </div>

  </div>

</section>

<!-- section first end -->



<section id="dropdown-page6">

  <div class="container">

    <form autocomplete="off" action="/action_page.php">

      <div class="autocomplete col-lg-6 col-10 offset-1">

        <h2 class="headpagesix">Projects</h2>

        <div class="select-dropdown">
<select class="select2" id="multiple-select-field">

  </select>
</div>

      </div>

    </form>

  </div>

</section>













<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
 $('#loading').hide(); 
  
  $('#multiple-select-field').select2({
});

</script>


<script>



$(document).ready(function(){
      mixpanel.track("<?php echo $_COOKIE['username']; ?>", {
        "PageName": lastPathSegment.replace(".php", ""),
         "collateralevent": "Project List",
        });

    $(document).on("change","#multiple-select-field",function(){
        if($(this).val() > 0){

          $("#project_id").val($(this).val());

      
          $("#ProjectLeads").submit();
        }
    })

    let project_details = [];

    GetProjects()

    $( "#project" ).autocomplete({  

      source: project_details,

      select: function(event, ui) {

          var id = ui.item.id;

          $("#project_id").val(id);

          $("#ProjectLeads").submit();

        

      } 

    });

    function GetProjects(){

         var fd = new FormData();    

        fd.append( 'token', '<?php echo $_COOKIE['token'] ?>' );

        fd.append( 'email', '<?php echo $_COOKIE['username'] ?>' );

        
        $.ajax({

          url: 'https://houseofhiranandani-kandivali.info/Hohadmin/public/api/GetProjects',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function(data){

            var html = '';
            html += '<option value="0">Select Project</option>';
            $.each(data.project ,function(arr,i){

                project_details.push({'label':i.project_name+', '+i.city_name, 'id': i.id})
                html += '<option value="'+i.id+'">'+i.project_name+', '+i.city_name+'</option>';

            })

            $('#multiple-select-field').html(html);

            console.log(project_details);

          }

        });

    }

})

//   function autocomplete(inp, arr) {

//     /*the autocomplete function takes two arguments,

//     the text field element and an array of possible autocompleted values:*/

//     var currentFocus;

//     /*execute a function when someone writes in the text field:*/

//     inp.addEventListener("input", function (e) {

//       var a, b, i, val = this.value;

//       /*close any already open lists of autocompleted values*/

//       closeAllLists();

//       if (!val) { return false; }

//       currentFocus = -1;

//       /*create a DIV element that will contain the items (values):*/

//       a = document.createElement("DIV");

//       a.setAttribute("id", this.id + "autocomplete-list");

//       a.setAttribute("class", "autocomplete-items");

//       /*append the DIV element as a child of the autocomplete container:*/

//       this.parentNode.appendChild(a);

//       /*for each item in the array...*/

//       for (i = 0; i < arr.length; i++) {

//         /*check if the item starts with the same letters as the text field value:*/

//         if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

//           /*create a DIV element for each matching element:*/

//           b = document.createElement("DIV");

//           /*make the matching letters bold:*/

//           b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";

//           b.innerHTML += arr[i].substr(val.length);

//           /*insert a input field that will hold the current array item's value:*/

//           b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

//           /*execute a function when someone clicks on the item value (DIV element):*/

//           b.addEventListener("click", function (e) {

//             /*insert the value for the autocomplete text field:*/

//             inp.value = this.getElementsByTagName("input")[0].value;

//             /*close the list of autocompleted values,

//             (or any other open lists of autocompleted values:*/

//             closeAllLists();

//           });

//           a.appendChild(b);

//         }

//       }

//     });

//     /*execute a function presses a key on the keyboard:*/

//     inp.addEventListener("keydown", function (e) {

//       var x = document.getElementById(this.id + "autocomplete-list");

//       if (x) x = x.getElementsByTagName("div");

//       if (e.keyCode == 40) {

//         /*If the arrow DOWN key is pressed,

//         increase the currentFocus variable:*/

//         currentFocus++;

//         /*and and make the current item more visible:*/

//         addActive(x);

//       } else if (e.keyCode == 38) { //up

//         /*If the arrow UP key is pressed,

//         decrease the currentFocus variable:*/

//         currentFocus--;

//         /*and and make the current item more visible:*/

//         addActive(x);

//       } else if (e.keyCode == 13) {

//         /*If the ENTER key is pressed, prevent the form from being submitted,*/

//         e.preventDefault();

//         if (currentFocus > -1) {

//           /*and simulate a click on the "active" item:*/

//           if (x) x[currentFocus].click();

//         }

//       }

//     });

//     function addActive(x) {

//       /*a function to classify an item as "active":*/

//       if (!x) return false;

//       /*start by removing the "active" class on all items:*/

//       removeActive(x);

//       if (currentFocus >= x.length) currentFocus = 0;

//       if (currentFocus < 0) currentFocus = (x.length - 1);

//       /*add class "autocomplete-active":*/

//       x[currentFocus].classList.add("autocomplete-active");

//     }

//     function removeActive(x) {

//       /*a function to remove the "active" class from all autocomplete items:*/

//       for (var i = 0; i < x.length; i++) {

//         x[i].classList.remove("autocomplete-active");

//       }

//     }

//     function closeAllLists(elmnt) {

//       /*close all autocomplete lists in the document,

//       except the one passed as an argument:*/

//       var x = document.getElementsByClassName("autocomplete-items");

//       for (var i = 0; i < x.length; i++) {

//         if (elmnt != x[i] && elmnt != inp) {

//           x[i].parentNode.removeChild(x[i]);

//         }

//       }

//     }

//     /*execute a function when someone clicks in the document:*/

//     document.addEventListener("click", function (e) {

//       closeAllLists(e.target);

//     });

//   }



//   /*An array containing all the country names in the world:*/

//   var countries = project_details;



//   /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/

//   autocomplete(document.getElementById("myInput"), countries);

</script>



</body>



</html>

