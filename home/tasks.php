<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tasks</title>

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
    .bg-addTop{
      background-color: #f1f1f1;
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
          <h2> Your Tasks </h2>
        </div>
        <div class="col sideButton align-right">
          <span><button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#form"><i class="bi bi-bookmark-plus"></i> Assign</button></span>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="row align-items-top">
        <div class="row">

        <?php
          $response = getApi('tasks');
          $data = json_decode($response, true);

          foreach ($data['tasks'] as $task) {
            $date = date_create($task['deadline']);
						$deadline = date_format($date, "jS M Y");

            if($task['task_status'] == 0 && $task['assigned_to'] == $_SESSION['user_srno'])
              echo "
              <div class='col-md-4'>
                <div class='card'>
                  <div class='card-header bg-primary'></div>
                  <div class='card-body'>
                    <h5 class='card-title'> ".$task['task_name']."</h5>
                    <p><b>Deadline:</b> ".$deadline."</p>
                    <p><b>Description:</b> ".$task['task_description']."</p>
                  </div>
                  <div class='card-footer'>
                  <form action='apicalls/updateTask.php' method='POST'>
                    <button type='submit' name='task_srno' value=".$task['task_srno']." class='btn btn-success'><i class='bi bi-check-circle'></i> Done</button>
                  </form>
                  </div>
                </div>
              </div>";
          } 
        ?>

        </div>
      </div>
    </section>

    <div class="pagetitle">
      <h2> Ongoing Tasks </h2>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="row">

          <?php
          foreach ($data['tasks'] as $task) {
            if($task['task_status'] == 0)
            {
            $date = date_create($task['deadline']);
						$deadline = date_format($date, "jS M Y");

            $respo = getApi('users/'.$task['assigned_to']);
            $datas = json_decode($respo, true);
            foreach($datas['users'] as $user)
            {
              $name = $user['name'];
            }

            echo "
            <div class='col-md-4'>
              <div class='card'>
                <div class='card-header bg-warning'></div>
                <div class='card-body'>
                <h5 class='card-title'> ".$task['task_name']."</h5>
                <p><b>Assigned to:</b> ".$name."</p>
                <p><b>Deadline:</b> ".$deadline."</p>
                <p><b>Description:</b> ".$task['task_description']."</p>
                </div>
              </div>
            </div>";
            }
          }
          ?>

        </div>
      </div>
    </section>

    <div class="pagetitle">
      <h2> Completed </h2>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="row">

        <?php
          foreach ($data['tasks'] as $task) {
            if($task['task_status'] == 1)
            {
            $date = date_create($task['deadline']);
						$deadline = date_format($date, "jS M Y");

            $respo = getApi('users/'.$task['assigned_to']);
            $datas = json_decode($respo, true);

            foreach($datas['users'] as $user)
            {
              $name = $user['name'];
            }

            echo "
            <div class='col-md-4'>
              <div class='card'>
                <div class='card-header bg-success'></div>
                <div class='card-body'>
                <h5 class='card-title'> ".$task['task_name']."</h5>
                <p><b>Assigned to:</b> ".$name."</p>
                <p><b>Deadline:</b> ".$deadline."</p>
                <p><b>Description:</b> ".$task['task_description']."</p>
                </div>
              </div>
            </div>";
            }
          }
          ?>

        </div>
      </div>
    </section>

    <div class="modal fade" id="form" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-addTop">
            <h5 class="modal-title">Assign task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style='background-color:#d1d0d0; border-radius:8vh'></button>
          </div>
          <div class="modal-body">
            <form action="apicalls/addTask.php" method="POST">

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Task</label>
                <div class="col-sm-10">
                  <input type="text" name="task_name" class="form-control">
                </div>
              </div>

              <div class='row mb-3'>
                <label class='col-sm-2 col-form-label'>Member</label>
                <div class='col-sm-10'>
                  <select class='form-select' name="assigned_to" aria-label='Default select example'>
                    <option selected>Select Member</option>

                      <?php
                      $userResponse = getApi('users');
                      $userJson = json_decode($userResponse, true);
                      foreach($userJson['users'] as $user)
                      {
                        if($user['user_role'] != 'p')
                          echo"<option value='".$user['user_srno']."'>".$user['name']."</option>";
                      }
                      ?>

                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Deadline</label>
                <div class="col-sm-10">
                  <input type="date" name="deadline" class="form-control">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Details</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="task_description" style="height: 100px"></textarea>
                </div>
              </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Assign</button>
            </form>
          </div>

        </div>
      </div>
    </div>

  </main><!-- End #main -->

  <?php
  require 'footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>