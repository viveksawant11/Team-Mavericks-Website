<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />
  <title>Team Mavericks</title>
  <link rel="icon" href="assets/images/Mavericks_new_logo-2.png">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">

  <script src="https://kit.fontawesome.com/148eb6c208.js" crossorigin="anonymous"></script>


 <style>
 .s-block{
     height:100%;
 }
 .dark h5{
     color:white;
 }
 .dark h6{
     color:white;
 }
 .dark h4{
     color:white;
 }
.dark  #wht:hover{
      color: white;
    }
    .owl-stage-outer{
        display:flex;
        justify-content:center;
    }
    .btn:hover{
          border-color:var(--secondary);
          background-color:rgba(11,87,209,1);
          color:white;
      }
    }
    .modalSuccess {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modalSuccess-content {
        background-color: #fefefe;
        border: 2px solid black;
        border-radius: 2vh;
        width: 50vh;
        height: 35vh;
        margin: auto;
        padding: 20px;
    }
    
    .card-title
    {padding:1.25rem;}
 </style>
</head>

<body>
  <!--header-->
  <section class="w3l-header">
    <header id="site-header" class="fixed-top nav-fixed">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark stroke">
          <a style="background-color:rgb(255,255,255,0.9); border-radius:0.2em; width:10em;"class="navbar-brand" href="index.php">
            <img style="margin-left:0.4em;"class="logo-height" src="assets/images/Mavericks_new_logo-2.png" alt="Your logo" title="Your logo" />
            Team Mavericks
          </a>
          <!--<button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"-->
          <!--  data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"-->
          <!--  aria-label="Toggle navigation">-->
          <!--  <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>-->
          <!--  <span class="navbar-toggler-icon fa icon-close fa-times"></span>-->
         
          <!--</button>-->

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item @@events-active">
                <a class="nav-link" href="ourEvents.html">Events</a>
              </li>
              <li class="nav-item @@about-active">
                <a class="nav-link" href="about.html">About</a>
              </li>
              <li class="nav-item @@contact-active">
                <a class="nav-link" href="contact.html">Contact</a>
              </li>

            </ul>
          </div>

        </nav>
      </div>
    </header>
    <!--/header-->
  </section>
  <!-- index-block1 -->
  <div class="w3l-index1">
      <img src="assets/images/home-banner.webp" style="width:100%;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 content-left">
          </div>
        </div>
        <div class="clear"></div>
      </div>
  </div>
  <!-- //index-block1 -->

  <!-- courses Section -->
  <section class="w3l-courses py-5">
    <div class="container py-lg-3">
      <div id="event" class="header-section mb-5 text-center mx-auto">
        <h3>Our Events</h3>
        <h6 class="my-3"> Throughout the year we organize various technical and non-technical events.</h6>
      </div>

        <div class="row bottom_grids pt-md-3">

        <?php
         $flag=0;
         require('home/apicalls/apicall.php');
         $response = getApi('events');
         $data = json_decode($response, true);
         foreach($data['events'] as $event){
             if($event['event_approval'] == 1 && $event['event_status'] == 0)
             {
                $flag=1;
                $date = date_create($event['event_date']);
				$time = $event['event_time'];
				$event_date = date_format($date, "j M Y");
				$event_time = date('h:i a', strtotime($time));
             echo"
            <div class='col-lg-4 col-md-6 mt-5' id=".$event['event_srno'].">
              <div class='card'>
                <img src='home/assets/img/banners/event".$event['event_srno'].".webp' class='card-img-top' alt='...'>
                <h4 style='padding-bottom:1vh' class='card-title'>".$event['event_name']."</h4>
                <div class='card-body'>
                  <p style='padding-bottom:1vh'><i class='fa-regular fa-calendar-days fa-xl'></i> ".$event_date."</p>
                  <p style='padding-bottom:1vh'><i class='fa-regular fa-clock fa-spin fa-xl'></i> ".$event_time."</p>
                   <p style='padding-bottom:3vh'>".$event['event_description']."</p>
                   
                   <div class = 'row' >
                        <div class = 'col' style='display:flex;justify-content:center'>
                          <span><a href='home/assets/documents/event".$event['event_srno'].".pdf' download='".$event['event_name']."'><button class = 'btn btn-outline-primary dark'><i class='fa fa-file-arrow-down'></i>  Brochure</button></a></span>
                        </div>
                        <div class = 'col' style='display:flex;justify-content:center'>
                        <form action='pass.php' method='post' style='all:revert'>
                          <span><button class='btn btn-primary dark' name='event_srno' value='".$event['event_srno']."' type='submit'>Register</button></span>
                        </form>
                        </div>
                          
                    </div>
                </div>
              </div>
            </div>";
                 
             }
         }
        ?>
   
        </div>
        <?php
        if($flag==0)
             echo"<div style='text-align:center'><p><i>No Upcoming Events</i></p></div>";
        ?>
      
    </div>
  </section>

  <!-- index-block2 -->
  <section class="w3l-index2 py-5">
    <div class="container py-md-3">
      <div class="header-section text-center mx-auto">
        <h3>Stay Updated, Stay Ahead </h3>
      </div>
      
      <div class="row bottom_grids pt-md-3 text-center">
          
        <div class="col-lg-4 col-md-6 mt-5">
          <div class="s-block">
            <a href="" class="d-block p-lg-4 p-3">
              <img src="assets/images/s1.webp" alt="" class="img-fluid img-curve" />
              <h3 class="my-3">Stay Updated, <br> Stay Ahead!</h3>
              <p class="">Our powerful tagline that emphasizes the importance of staying informed and ahead of the competition.</p>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-5">
          <div class="s-block">
            <a href="" class="d-block p-lg-4 p-3">
              <img src="assets/images/s3.webp" alt="" class="img-fluid img-curve" />
              <h3 class="my-3">Learning with Fun</h3>
              <p class="">Learning with fun is a dynamic and engaging approach that fosters a positive and enjoyable learning experience.</p>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-5">
          <div class="s-block">
            <a href="" class="d-block p-lg-4 p-3">
              <img src="assets/images/s2.webp" alt="" class="img-fluid img-curve" />
              <h3 class="my-3">For the Students, <br> By the Students!</h3>
              <p class="">This is a student-run organisation. It was founded by the students where all the activities are organised and conducted by the students.</p>
            </a>
          </div>
        </div>
        
      </div>
      
    </div>
  </section>
  <!-- /index-block2 -->

  <footer>
    <!-- footer -->
    <section class="w3l-footer">
      <div class="w3l-footer-16-main py-5">
        <div class="container">
          <div class="row footer-border">
            <div class="col-lg-12 text-center col-md-5 column pr-md-0">
              <a class="navbar-brand" href="#index.php" id="wht">
                <img class="logo-height" src="assets/images/Mavericks_new_logo-2.png" alt="Your logo"
                  title="Your logo" /> Team Mavericks
              </a>
              <p>We, Team Mavericks symbolize a team having unorthodox views <br>
                and innovative ideas. "Maverick" means an independent person or <br>
                a team who is similar to a bird that loves to live a free and prosperous life.</p>
              <ul class="mt-4 contact">
                <li>
                  <p><span class="fa fa-phone" aria-hidden="true"></span> <a id="wht" href="tel:+919766246585">9766246585</a>
                  </p>
                </li>
                <li>
                  <p><span class="fa fa-envelope" aria-hidden="true"></span> <a id="wht"
                      href="email:mavericksbodhantra@gmail.com">mavericksbodhantra@gmail.com</a></p>
                </li>
              </ul>
            </div>

          </div>
          <div class="below-section pt-4 mt-5 text-center">
            <div class="columns-2">
              <ul class="social">
                <li><a id="wht" href="https://www.facebook.com/TeamMavericksKIT"><span class="fa fa-facebook"
                      aria-hidden="true"></span></a>
                </li>
                <li><a href="https://www.linkedin.com/in/teammavericks/?originalSubdomain=in"><span
                      class="fa fa-linkedin" aria-hidden="true"></span></a>
                </li>
                <li><a id="wht" href="#twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                </li>
                <li><a id="wht" href="https://www.instagram.com/teammavericks.kit/"><span class="fa fa-instagram"
                      aria-hidden="true"></span></a>
                </li>
                <li><a id="wht" href="https://wa.me/9766246585"><span class="fa fa-whatsapp" aria-hidden="true"></span></a>
                </li>
              </ul>
            </div>
            <div class="columns mt-3">
              <p>&copy; 2023 Team Mavericks. All rights reserved.
              </p>
            </div>
          </div>
        </div>
      </div>
      
     
      <!-- move top -->
      <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-angle-up"></span>
      </button>
      <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          scrollFunction()
        };

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
          } else {
            document.getElementById("movetop").style.display = "none";
          }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
      </script>
      <!-- //move top -->
    //   <script>
    //     $(function () {
    //       $('.navbar-toggler').click(function () {
    //         $('body').toggleClass('noscroll');
    //       })
    //     });
    //   </script>
    </section>
    <!-- //footer -->
  </footer>

  <!-- jQuery JS -->
  <!-- <script src=" js/jquery-3.4.1.slim.min.js"></script> -->
  <!-- jQuery JS -->
  <script src="assets/js/jquery-1.9.1.min.js"></script>

  <!-- Template JavaScript -->

  <!-- owl carousel -->
  <script src="assets/js/owl.carousel.js"></script>
  
  <!-- magnific popup -->
  <script src=" assets/js/jquery.magnific-popup.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
      });

      $('.popup-with-move-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom'
      });
    });
  </script>

  <!-- responsive tabs -->
  <script src="assets/js/easyResponsiveTabs.js"></script>

  <!--Plug-in Initialisation-->
  <script type="text/javascript">
    $(document).ready(function () {
      //Horizontal Tab
      $('#parentHorizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function (event) { // Callback function if tab is switched
          var $tab = $(this);
          var $info = $('#nested-tabInfo');
          var $name = $('span', $info);
          $name.text($tab.text());
          $info.show();
        }
      });
    });
  </script>

  <!-- stats number counter-->
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.countup.js"></script>
  <script>
    $('.counter').countUp();
  </script>
  <!-- //stats number counter -->

  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->

  <!--/MENU-JS-->
//   <script>
//     $(window).on("scroll", function () {
//     //   var scroll = $(window).scrollTop();

//     //   if (scroll >= 0) {
//     //     $("#site-header").addClass("nav-fixed");
//     //   } else {
//     //     $("#site-header").removeClass("nav-fixed");
//     //   }
//     // });

//     //Main navigation Active Class Add Remove
//     $(".navbar-toggler").on("click", function () {
//       $("header").toggleClass("active");
//     });
//     $(document).on("ready", function () {
//       if ($(window).width() > 991) {
//         $("header").removeClass("active");
//       }
//       $(window).on("resize", function () {
//         if ($(window).width() > 991) {
//           $("header").removeClass("active");
//         }
//       });
//     });
//   </script>
  <!--//MENU-JS-->

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>