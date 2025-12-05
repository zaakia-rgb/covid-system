<!DOCTYPE html>
<html lang="en">
<head>
     <title>COVID Vaccination Center</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/tooplate-style.css">

     <style>
          .service-box {
               padding: 25px;
               background: #fff;
               border-radius: 12px;
               text-align:center;
               margin-bottom:25px;
               box-shadow:0 0 15px rgba(0,0,0,0.08);
               transition:0.3s;
               min-height: 220px;
          }
          .service-box:hover {
               transform:translateY(-6px);
               box-shadow:0 0 20px rgba(0,0,0,0.15);
          }
          .icon {
               font-size:45px;
               margin-bottom:15px;
               color:#0aa6d4;
          }
     </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<!-- PRE LOADER -->
<section class="preloader">
     <div class="spinner">
          <span class="spinner-rotate"></span>
     </div>
</section>

<!-- HEADER -->
<header>
     <div class="container">
          <div class="row">
               <div class="col-md-4 col-sm-5">
                    <p>Welcome to COVID Vaccination Center</p>
               </div>
               <div class="col-md-8 col-sm-7 text-right">
                    <span class="phone-icon"><i class="fa fa-phone"></i> 010-060-0160</span>
                    <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> Mon-Fri (6 AM - 10 PM)</span>
                    <span class="email-icon"><i class="fa fa-envelope-o"></i> covidcenter.com</span>
               </div>
          </div>
     </div>
</header>

<!-- NAVBAR -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
     <div class="container">

          <div class="navbar-header">
               <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
               </button>
               <a href="index.php" class="navbar-brand"><i class="fa fa-medkit"></i> COVID Center</a>
          </div>

          <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                    <li><a href="#home" class="smoothScroll">Home</a></li>
                    <li><a href="#about" class="smoothScroll">About</a></li>
                    <li><a href="#team" class="smoothScroll">Experts</a></li>
                    <li><a href="#news" class="smoothScroll">Updates</a></li>

                    <!-- Login / Signup -->
                    <li><a href="login.php" class="btn btn-primary" style="color:white;">Login</a></li>
                    <li><a href="signup.php" class="btn btn-success" style="margin-left:10px; color:white;">Sign Up</a></li>
               </ul>
          </div>

     </div>
</section>

<!-- HOME -->
<section id="home" class="slider" data-stellar-background-ratio="0.5">
     <div class="container">
          <div class="row">

               <div class="owl-carousel owl-theme">

                    <div class="item item-first">
                         <div class="caption">
                              <h3>Stay Safe, Stay Healthy</h3>
                              <h1>COVID Awareness</h1>
                              <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Experts</a>
                         </div>
                    </div>

                    <div class="item item-second">
                         <div class="caption">
                              <h3>Protect Yourself</h3>
                              <h1>Get Vaccinated</h1>
                              <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">Learn More</a>
                         </div>
                    </div>

                    <div class="item item-third">
                         <div class="caption">
                              <h3>Stay Updated</h3>
                              <h1>Latest COVID News</h1>
                              <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read Updates</a>
                         </div>
                    </div>

               </div>

          </div>
     </div>
</section>

<!-- PATIENT PORTAL -->
<section id="patient-portal" style="padding:60px 0; background:#f5f5f5;">
    <div class="container">
        <div class="section-title text-center">
            <h2>Patient Services</h2>
            <p>COVID-19 related services and portal access</p>
        </div>

        <div class="row" style="margin-top:40px;">

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-user-plus icon"></i>
                    <h4>Create Account</h4>
                    <a href="signup.php" class="btn btn-primary btn-block">Register</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-sign-in icon"></i>
                    <h4>Login</h4>
                    <a href="login.php" class="btn btn-success btn-block">Login</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-hospital-o icon"></i>
                    <h4>Search Hospitals</h4>
                    <a href="hospital_search.php" class="btn btn-info btn-block">Search</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-calendar icon"></i>
                    <h4>Book Appointment</h4>
                    <a href="appointment.php" class="btn btn-warning btn-block">Book Now</a>
                </div>
            </div>

        </div>

        <div class="row" style="margin-top:25px;">

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-flask icon"></i>
                    <h4>COVID Test Request</h4>
                    <a href="covid_test.php" class="btn btn-danger btn-block">Request Test</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-check-circle icon"></i>
                    <h4>Vaccination Status</h4>
                    <a href="vaccine_status.php" class="btn btn-primary btn-block">Check Status</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-file-text icon"></i>
                    <h4>COVID Test Result</h4>
                    <a href="test_results.php" class="btn btn-default btn-block">View Results</a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-box">
                    <i class="fa fa-user icon"></i>
                    <h4>My Profile</h4>
                    <a href="profile.php" class="btn btn-dark btn-block">Profile</a>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ABOUT -->
<section id="about">
     <div class="container">
          <div class="row">
               <div class="col-md-6">
                    <h2>COVID Vaccination Information</h2>
                    <p>Vaccination helps to protect yourself and your loved ones from severe COVID-19.</p>
               </div>
          </div>
     </div>
</section>

<!-- NEWS -->
<section id="news" data-stellar-background-ratio="2.5">
     <div class="container">
          <div class="row">

               <div class="col-md-12">
                    <h2 class="text-center">COVID Updates</h2>
               </div>

               <div class="col-md-4">
                    <img src="images/news-image1.jpg" class="img-responsive" alt="">
                    <h4>New Vaccine Guidelines</h4>
               </div>

               <div class="col-md-4">
                    <img src="images/news-image2.jpg" class="img-responsive" alt="">
                    <h4>COVID Safety Measures</h4>
               </div>

               <div class="col-md-4">
                    <img src="images/news-image3.jpg" class="img-responsive" alt="">
                    <h4>Vaccination Drive</h4>
               </div>

          </div>
     </div>
</section>

<footer>
     <div class="container">
          <div class="row">

               <div class="col-md-4">
                    <h4>Contact</h4>
                    <p>010-070-0170</p>
                    <p>info@covidcenter.com</p>
               </div>

               <div class="col-md-4">
                    <h4>Latest News</h4>
                    <p>New vaccine rules updated.</p>
               </div>

               <div class="col-md-4">
                    <h4>Opening Hours</h4>
                    <p>Mon-Fri: 6 AM - 10 PM</p>
               </div>

          </div>
     </div>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
