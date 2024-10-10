<?php
  session_start();

  if(!isset($_SESSION['participant_email']))
     header('location:emailVerification.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['first'] != '' && $_POST['second'] != '' && $_POST['third'] != '' && $_POST['fourth'] != '' ){ 
    $OTP = $_POST['first']*1000 + $_POST['second']*100 + $_POST['third']*10 + $_POST['fourth'];
    
    if($OTP == $_SESSION['OTP']){
        $_SESSION['success'] =1;
        header('location:register.php');
    }
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $_SESSION['tries'] = $_SESSION['tries'] - 1;

    if($_SESSION['tries'] < 1)
      header('location:emailVerification.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OTP</title>

  <!-- Favicons -->
  <link href="assets2/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="assets2/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo $_SESSION['event_name']; ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">OTP Verification</h5>
                    <p class="text-center small">Please enter the OTP sent to your email</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="otp.php" method="POST">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                      echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert' style='padding:1vh'>
                      Incorrect OTP!  <b>".$_SESSION['tries']."</b> Tries left!
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' style='padding:1.5vh 1.5vh'></button>
                    </div>";
                    ?>

                    <div class="col-12">
                      <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                        <input class="m-2 text-center form-control rounded" type="text" name ="first" id="first" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name ="second" id="second" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name ="third" id="third" maxlength="1" />
                        <input class="m-2 text-center form-control rounded" type="text" name ="fourth" id="fourth" maxlength="1" />
                      </div>
                    </div>

                    <div class="col-12"></div>

                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit"><i class="bi bi-patch-check"></i> Verify</button>
                    </div>

                    <div class="col-12">
                    </div>
                  </form>

                </div>
              </div>

              <div class='copyright' style="font-size:1.2vh">
                &copy; Copyright <strong><span>2023 Team Mavericks</span></strong>. All Rights Reserved
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets2/js/otp.js"></script>
  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>

</html>