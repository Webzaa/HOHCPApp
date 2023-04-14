<!doctype html>
<!-- <html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOH Mobile App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/responsive1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head> -->
<?php  include 'header.php'; ?>
<style>
    body{
        background-color: #fff;
        background-image: none;
        font-family: "Montserrat";
        font-weight: 600;  
    }
    
    .scrollmain::-webkit-scrollbar-button:vertical:increment {
    background-color: red;
}
    
.scrollmain::-webkit-scrollbar-button:vertical:decrement {
    background-color: green;
}
    
.scrollmain::-webkit-scrollbar-button:horizontal:increment {
    background-color: yellow;
}
    
.scrollmain::-webkit-scrollbar-button:horizontal:decrement {
    background-color: blue;
}
/* 
You can do this by simple apply overflow-y:scroll on that div. I hope this will help you. */



</style>
<body>
    <section id="third-main">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-6 col-6"><img src="img/lessthanarrow-new.png" class="singlearrow"><span>Enquiry</span></div>
                <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp">Help</button> </div>
            </div>
        </div>
        </section> 

        <section id="third-table">
            <div class="container">
                <h2 class="head-pagethree">Enquiry List</h2>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="colspan-3" class="col-sm-3" >Customer Name</th>
                        <th scope="colspan-3" class="col-sm-3" >Email ID</th>
                        <th scope="colspan-3" class="col-sm-3" >Mobile Number</th>
                        <th scope="colspan-3" class="col-sm-3" >Date of Enquiry</th>
                        <th scope="colspan-3" class="col-sm-3" >Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Otto</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>Thornton</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        
                      </tr>
                    </tbody>
                  </table>
            </div>
        </section>

        <div class="scrollmain"></div>
          

</body>
</html>
