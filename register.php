<?php
    session_start();
    if (!isset($_SESSION['event_srno']))
      header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>

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
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="assets2/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo $_SESSION['event_name']; ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Registration Form</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="addRegistration.php" method="POST" onsubmit="myButton.disabled = true; return true;" enctype="multipart/form-data">

                    <div class="col-12">
                      <label for="inputText" class=" col-form-label">Full Name</label>
                      <div class="col-sm-12">
                        <input type="text" name="name" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputText" class="col-form-label">Whatsapp Number</label>
                      <div class="col-sm-12">
                        <input type="text" name="contact" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputText" class="col-form-label">College Name</label>
                      <div class="col-sm-12">
                        <input type="text" name="college" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputText" class="col-form-label">Department</label>
                      <div class="col-sm-12">
                        <input type="text" name="department" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputText" class="col-form-label">Payment QR</label>
                      <div class="col-sm-12">
                        <?php echo "<image src='home/assets/img/qr/qr".$_SESSION['event_srno'].".png' style='max-width:30vh'>"; ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputNumber" class=" col-form-label">Upload Payment Proof</label>
                      <div class="col-sm-12">
                        <input class="form-control" type="file" name="image" id="image" accept="image/jpg" required>
                      </div>
                    </div>

                    <div class="col-12"></div>

                    <div class="col-12">
                      <button class="btn btn-success w-100" name='myButton' type="submit"><i class="bi bi-check2-circle"></i> Register</button>
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
  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>

</html>