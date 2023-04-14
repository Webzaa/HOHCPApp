<!doctype html>
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
        background-color: #fff;
        background-image: none;
    }
</style>

<body>
    <section id="third-main">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-lg-6 col-6"><i class="fa-solid fa-less-than"></i><span>Projects</span></div>
                <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp">Help</button> </div>
            </div>
        </div>
    </section>

    <section id="form">
        <div class="form-inner">
            <div class="container">
                <h2 class="form-head">ENQUIRE NOW</h2>
                <form>
                    <div class="mb-3">
                      <input type="name" class="form-control enquire-formcontrol" id="exampleInputname1" 
                      aria-describedby="nameHelp" placeholder="Name*">
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control enquire-formcontrol" id="exampleInputemail1" placeholder="Email ID*">
                    </div>
                    <div class="mb-3">
                      <input type="number" class="form-control enquire-formcontrol" id="exampleInputmobile1" placeholder="Mobile Number*">
                    </div>
                    <button type="submit" class="btn fixed-bottom form-submitbtn">Submit</button>
                  </form>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function download_file() {
            document.getElementById("my_download").click()
        }
    </script>

</body>

</html>
