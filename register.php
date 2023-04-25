<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <!-- <link rel="icon" type="image/png" href="assets/img/favicon.png"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    VIOPAY: Register
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="dropdown button-dropdown">
        <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
          <span class="button-bar"></span>
          <span class="button-bar"></span>
          <span class="button-bar"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-header">Menu</a>
          <a class="dropdown-item" href="index.php">Home</a>
          <a class="dropdown-item" href="login.php">Login</a>
          <a class="dropdown-item" href="register.php">Sign Up</a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="#" rel="tooltip" title="Computer Science 2022" data-placement="bottom">
          VIOPAY
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Back to Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header clear-filter" filter-color="" style="background-color: rgba(179, 179, 255, 0.6);">
    <div class="page-header-image" style="background-image:url(assets/img/register.jpg)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="post" action="#" id="form">
              <div class="card-header text-center">
                <div class="logo-container">
                  <!-- <img src="assets/img/now-logo.png" alt=""> -->
                </div>
              </div>
              <p style="color: #ff8533;" id="error"></p>
              <div class="card-body">
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" >
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_single-02"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name"/>
                </div>
                <!-- <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons text_caps-small"></i>
                    </span>
                  </div>
                  <input  class="form-control" type="text" id="vnumber" name="vnumber" placeholder="Vehicle Number"/>
                </div> -->
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons ui-1_email-85"></i>
                    </span>
                  </div>
                  <input class="form-control" type="email" id="email" name="email" placeholder="Email"/>
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons tech_mobile"></i>
                    </span>
                  </div>
                  <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone Number"/>
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </span>
                  </div>
                  <input type="password" id="password" name="password2" placeholder="Password" class="form-control"/>
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </span>
                  </div>
                  <input type="password" id="password2" name="password2" placeholder="Repeat Password" class="form-control"/>
                </div>
              </div>
              <div class="card-footer text-center">
                <input type="submit" class="btn btn-info btn-round btn-lg btn-block" name="submit" id="submit" value="Register" />
                <div class="pull-left">
                  <h6>
                    <a href="login.php" class="link">Login</a>
                  </h6>
                </div>
                <!-- <div class="pull-right">
                  <h6>
                    <a href="#" class="link">Forgot Password</a>
                  </h6>
                </div> -->
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class=" container ">
        <nav>
          <ul>
            <li>
              <a href="#">
                VIOPAY
              </a>
            </li>
            <li>
              <a href="#">
                About Us
              </a>
            </li>
          </ul>
        </nav>
        <div class="copyright" id="copyright">
          Chijiuba Victory &nbsp; &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
  <script>
    $(document).ready(function(){
      
      $('#form').submit(function(e){
        e.preventDefault();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();
        var phone = $('#phone').val();
        // var vehicleNumber = $('#vnumber').val();

        $.ajax({
          url: 'includes/processes/processregister.php',
          type: 'post',
          data: {'fname':fname, 'lname':lname, 'email':email, 'phone':phone, 'password':password, 'password2':password2},
          beforeSend: function(){
            // $('#waiting').show();
            $('#submit').attr('disabled','true');
          },
          success: function(response){
            $('#submit').removeAttr('disabled');

            if(response == 'Registration was successful'){
              $("#error").css("color", "green");
              $('#error').text(response);
              setTimeout(window.location.assign('login.php'), 3500);
            }
            else{
              $("#error").css("color", "red");
              $('#error').text(response);
            }
          }
        });
        
      });
            
    });

  </script>
</body>

</html>