<?php
session_start();
require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profile Page</title>

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
              <img src='assets/img/profiles/user" . $user['user_srno'] . ".png' alt='Profile' class='rounded-circle'>
              <h2>" . $user['name'] . "</h2>
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

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Details</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
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

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form action='apicalls/updateUser.php' method='POST' enctype="multipart/form-data">
                  <?php
                  echo"
                  <div class='row mb-3'>
                    <label for='profileImage' class='col-md-4 col-lg-3 col-form-label'>Profile Image</label>
                    <div class='col-md-8 col-lg-9'>
                    <img src='assets/img/profiles/user" . $user['user_srno'] . ".webp' alt='Profile' class='rounded-circle'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='profileImage' class='col-md-4 col-lg-3 col-form-label'>Upload Image</label>
                    <div class='col-md-8 col-lg-9'>
                      <input class='form-control' name='image' type='file' accept='image/png' id='formFile'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='fullName' class='col-md-4 col-lg-3 col-form-label'>Full Name</label>
                    <div class='col-md-8 col-lg-9'>
                      <input name='name' type='text' class='form-control' id='fullName' value='".$user['name']."'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='contact' class='col-md-4 col-lg-3 col-form-label'>Your Role</label>
                    <div class='col-md-8 col-lg-9'>
                      <select class='form-select' name='user_designation' aria-label='Default select example'>
                        <option selected>Select your Role</option>
                        <option value='Web Designer'>Web Designer</option>
                        <option value='Creative Director'>Creative Director</option>
                        <option value='Graphic Designer'>Graphic Designer</option>
                        <option value='Document Supervisor'>Document Supervisor</option>
                        <option value='Digital Marketing'>Event Marketing</option>
                        <option value='Technology God'>Technology God</option>
                        <option value='Event Organizer'>Event Organizer</option>
                        <option value='Event Manager'>Event Manager</option>
                        <option value='Budget Manager'>Budget Manager</option>
                        <option value='Founder'>Founder</option>
                      </select>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='inputEmail' class='col-md-4 col-lg-3 col-form-label'>Email</label>
                    <div class='col-md-8 col-lg-9'>
                      <input type='email' name='email' value='".$user['email']."' class='form-control'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='inputText' class='col-md-4 col-lg-3 col-form-label'>About You</label>
                    <div class='col-md-8 col-lg-9'>
                      <textarea class='form-control' name='user_about' style='height: 100px'>".$user['user_about']."</textarea>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='inputDate' class='col-md-4 col-lg-3 col-form-label'>Date of birth</label>
                    <div class='col-md-8 col-lg-9'>
                      <input type='date' value=".$user['user_dob']." name='user_dob' class='form-control'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='fullName' class='col-md-4 col-lg-3 col-form-label'>Department</label>
                    <div class='col-md-8 col-lg-9'>
                      <input name='user_department' type='text' class='form-control' id='department' value='".$user['user_department']."'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='contact' class='col-md-4 col-lg-3 col-form-label'>Contact Number</label>
                    <div class='col-md-8 col-lg-9'>
                      <input name='contact' type='text' class='form-control' id='contact' value='".$user['contact']."'>
                    </div>
                  </div>

                  <div class='row mb-3'>
                    <label for='inputDate' class='col-md-4 col-lg-3 col-form-label'>Year Of Joining</label>
                    <div class='col-md-8 col-lg-9'>
                      <input type='month' value=".$user['user_joining']." name='user_joining' class='form-control'>
                    </div>
                  </div>

                  <div class='text-center'>
                    <button type='submit' name='user_srno' value='".$user['user_srno']."' class='btn btn-primary'>Save Changes</button>
                  </div>";
                  ?>

                </form><!-- End Profile Edit Form -->

              </div>

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form>

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

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