<?php 


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St Bridget Laboratory Management System</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="hospital Management System, Healthcare Management system, Healthcare ERP">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner" class="banner">
    <div class="bg-color">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container" >
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
              <!--<a class="navbar-brand" href="#"><img src="img/logo.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a> -->
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#banner">Home</a></li>
                <li class=""><a href="#service">Services</a></li>
                <li class=""><a href="#about">About</a></li>
                <li class=""><a href="#contact">Contact</a></li>--->
                <li class=""><a href="#testimonial" data-toggle="modal" data-target="#exampleModal">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <!--<img src="img/logo.png" class="img-responsive">-->
              <h1 class="banner-text text-center"><b>St Bridget</b></h1>
            </div>
            <div class="banner-text text-center">
              <?php 
              if(isset($_GET["status"]))
              {
                $status = $_GET["status"];
              ?>
              <h3 class="orange" style="color: red;"><?php echo $status; ?></h3>
              <?php
              }
              ?>
              <h1 class="white">Laboratory Management System!!</h1>
              <p>This Laboratory Management System is designed and Customized for St Bridget Radiological Center, Laboratory Department.</p>
              <a href="#testimonial" class="btn btn-appoint" data-toggle="modal" data-target="#exampleModal">Login to Gain Access.</a>
            </div>
            <div class="overlay-detail text-center">
              <a href="#service"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--contact
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title"></h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <h3>Contact Info</h3>
          <div class="space"></div>
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>321 Awesome Street<br> New York, NY 17022</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@companyname.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+1 800 123 1234</p>
        </div>
      </div>
    </div>
  </section>
  -->
  <!--/ contact-->
  <!--footer-->

<!-- Modal -->
<div class="col-6">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Enter Login Details</h5>
      </div>
      <div class="modal-body">
        <form method="POST" action="login_queries.php">
            <h5 id="result"></h5>
          <div class="form-group">
            <input type="text" name="inputUsername" class="form-control" id="inputUsername" aria-describedby="emailHelp" placeholder="Enter username" required>
          </div>
          <div class="form-group">
            <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
            <button type="submit" id="submitbtn" class="btn btn-primary">login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!--/modal-->

  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <!--
        <div class="row">
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">About Us</h4>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Quick Links</h4>
            </div>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="index.html"><i class="fa fa-circle"></i>Home</a></li>
                <li><a href="#service"><i class="fa fa-circle"></i>Service</a></li>
                <li><a href="#contact"><i class="fa fa-circle"></i>Appointment</a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Follow us</h4>
            </div>
            <div class="info-sec">
              <ul class="social-icon">
                <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                <li class="bgred"><i class="fa fa-google-plus"></i></li>
                <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
              </ul>
            </div>
          </div>  -->
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medilab
              -->
              Designed by <a href="https://almagroup.com/">Alma Network Solution ©</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  <script type="text/javascript">
    /*var sbutton = document.getElementById('submitbtn');

    sbutton.onclick = function(){
      var user = document.getElementById('inputUsername').value;
      var pass = document.getElementById('inputPassword').value;
      alert(user);
      $.ajax({
                    type: 'POST',
                    url: 'login_queries.php',
                    data: {
                      staff_username: user,
                      staff_password: pass
                    },
                    success: function(data) {
                        $('#insertStatus').innerHTML(data);
                    }
                });
    }
      function loginDetails(id) {
            $('#specificClass').html('');
            alert('hello');
            $('#submitbtn').click(function(){
                var user = document.getElementById('inputUsername').value;
                var pass = document.getElementById('inputPassword').value;
                $.ajax({
                type: 'post',
                url: 'login_queries.php',
                data: {
                    staff_username: user,
                    staff_password: pass
                },
                success: function(data) {
                    $('#result').html(data);
                }
            })
            });
            
        }*/
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
