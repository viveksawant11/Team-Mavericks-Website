<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Members List</title>

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .sideButton {
      display: flex;
      justify-content: right;
    }

    #table_filter {
      display: flex;
      justify-content: right;
      align-items: right;
    }

    .fee {
      color: green;
    }

    .bg-addTop{
      background-color: #f1f1f1;
    }

    @media only screen and (max-width: 1080px) {

      .overflow {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
    }
  </style>

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
      <div class="row">
        <div class="col">
          <h2> Members </h2>
        </div>
        <div class="col sideButton align-right">
          <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add"><i class="bi bi-person-add"></i> Add Member</button>
        </div>
      </div>
    </div>

    <section class="section overflow">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>Sr. no.</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Department</th>
            <th>Joined</th>
            <th>Profile</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $response = getApi('users');
          $data = json_decode($response, true);

          $srno = 0;

          foreach ($data['users'] as $user) {
            $srno = $srno + 1;
            echo "
										<tr>
											<td >" . $srno . "</td>
											<td >" . $user['name'] . "</td>
											<td >" . $user['contact'] . "</td>
											<td >" . $user['email'] . "</td>
											<td >" . $user['user_department'] . "</td>
											<td >" . $user['user_joining'] . "</td>
                      <td>
                      <form action='viewProfile.php' method='post'>
                        <button class='btn btn-success' name='user_srno' value='" . $user['user_srno'] . "'><i
                            class='bi bi-eye-fill'></i> </button></form>
                      </td>
										</tr>";
          }
          ?>

        </tbody>
      </table>
    </section>
  </main><!-- End #main -->

  <div class="modal fade" id="add" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-addTop">
          <h5 class="modal-title">Add Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style='background-color:#d1d0d0; border-radius:8vh'></button>
        </div>
        <div class="modal-body">
          <form action="apicalls/addUser.php" method="POST">

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" name='name' class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Role</label>
              <div class="col-sm-10">
                <select class="form-select" name='role' aria-label="Default select example">
                  <option selected>Select Role</option>
                  <option value="a">Admin</option>
                  <option value="m">Member</option>
                  <option value="t">Treasurer</option>
                  <option value="p">Passout</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name='email' class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name='password' class="form-control">
              </div>
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
    require 'footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable({
        searching: true
      });
    });
  </script>
</body>

</html>