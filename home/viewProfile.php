<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>View Profile</title>

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <?php
    require 'header.php';
    require 'sidebar.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $userId = $_POST['user_srno'];
  
        $response = getApi('users/'.$userId);
        $data = json_decode($response, true);
  
        foreach($data['users'] as $userEntity)
        {
          $user = $userEntity;
        }
    }
    else
    {
      header("location:profile.php");
    }
    ?>

    <!-- ======= Sidebar ======= -->


    <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              
              <?php
              echo "
              <img src='assets/img/profiles/user".$user['user_srno'].".webp' alt='Profile' class='rounded-circle'>
              <h2>".$user['name']."</h2>
              <h3>".$user['user_designation']."</h3>";
              ?>

            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <?php
                echo "
                <div class='tab-pane fade show active profile-overview' id='profile-overview'>

                  <h5 class='card-title'>About</h5>
                  <p class='small fst-italic'>".$user['user_about']."</p>

                  <h5 class='card-title'>Other Details</h5>

                  <div class='row'>
                    <div class='col-lg-3 col-md-4 label'>Email</div>
                    <div class='col-lg-9 col-md-8'>" . $user['email'] . "</div>
                  </div>

                  <div class='row'>
                    <div class='col-lg-3 col-md-4 label'>Contact</div>
                    <div class='col-lg-9 col-md-8'>" . $user['contact'] . "</div>
                  </div>

                  <div class='row'>
                    <div class='col-lg-3 col-md-4 label'>Department</div>
                    <div class='col-lg-9 col-md-8'>" . $user['user_department'] . "</div>
                  </div>

                  <div class='row'>
                    <div class='col-lg-3 col-md-4 label'>Date of Birth</div>
                    <div class='col-lg-9 col-md-8'>" . $user['user_dob'] . "</div>
                  </div>

                  <div class='row'>
                    <div class='col-lg-3 col-md-4 label'>Year of Joining</div>
                    <div class='col-lg-9 col-md-8'>" . $user['user_joining'] . "</div>
                  </div>";
                  ?>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

    <?php
    require 'footer.php';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>