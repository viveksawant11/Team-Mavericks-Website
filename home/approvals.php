<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Approvals</title>

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .sideButton {
      display: flex;
      justify-content: right;
    }
  </style>

</head>

<body onload="modalPopup()">

  <!-- ======= Header ======= -->
  <?php
  require 'header.php';
  require 'sidebar.php';
  ?>

  <!-- ======= Sidebar ======= -->

  <main id="main" class="main" >

    <div class="pagetitle">
      <h2> Meeting Approvals </h2>
    </div>

    <section class="section">
      <div class="row align-items-top">
        <div class="row">

          <?php
          $response = getApi('meetings');
          $data = json_decode($response, true);

          foreach ($data['meetings'] as $meeting) {
              $date = date_create($meeting['meeting_date']);
              $time = $meeting['meeting_time'];
              $meeting_date = date_format($date, "jS M Y");
              $meeting_time = date('h:i a', strtotime($time));

              if ($meeting['meeting_approval'] == 0)
              echo "
                <div class='col-md-4'>
                  <div class='card'>
                    <div class='card-header bg-primary'></div>
                    <div class='card-body'>
                      <h5 class='card-title'>".$meeting_date."</h5>
                      <p>Time: ".$meeting_time."</p>
                      <p>Location: ".$meeting['meeting_location']."</p>
                      <p>Agenda: ".$meeting['meeting_agenda']."</p>
                    </div>
                    <div class='card-footer'>
                      <form action='apicalls/processMeetingApproval.php' method='POST'>
                        <button type='submit' name='approvedMeeting' value='".$meeting['meeting_srno']."'class='btn btn-success'><i class='bi bi-check-circle'></i> Approve</button>
                        <button type='submit' name='declinedMeeting' value='".$meeting['meeting_srno']."'class='btn btn-danger'><i class='bi bi-exclamation-octagon'></i> Decline</button>
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
      <h2> Event Approvals </h2>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="row">

        <?php        
        $response = getApi('events');
				$data = json_decode($response, true);

        foreach($data['events'] as $event){
            $date = date_create($event['event_date']);
            $time = $event['event_time'];
            $event_date = date_format($date, "jS M Y");
            $event_time = date('h:i a', strtotime($time));

            if ($event['event_approval'] == 0)
            echo "
              <div class='col-md-4'>
                <div class='card'>
                  <div class='card-header bg-warning'></div>
                  <div class='card-body'>
                    <h5 class='card-title'>".$event['event_name']."</h5>
                    <p>Date: ".$event_date."</p>
                    <p>Time: ".$event_time."</p>
                    <p>Location: ".$event['event_location']."</p>
                    <p>Fees: ".$event['event_fee']."</p>
                  </div>
                  <div class='card-footer'>
                    <form action='apicalls/processEventApproval.php' method='POST'>
                      <button type='submit' name='approvedEvent' value='".$event['event_srno']."' class='btn btn-success'><i class='bi bi-check-circle'></i> Approve</button>
                      <button type='submit' name='declinedEvent' value='".$event['event_srno']."' class='btn btn-danger'><i class='bi bi-exclamation-octagon'></i> Decline</button>
                    </form>
                  </div>
                </div>
              </div>";
          }
          ?>

        </div>
      </div>
    </section>

    <!-- Modals -->
    <div>

      <div class="modal fade" id="declined" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Request Declined !</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="display:flex;justify-content:center">
              <i class="bi bi-exclamation-octagon h1" style="color:red"></i>
            </div>
          </div>
        </div>
      </div>
          
      <div class="modal fade" id="approved" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Request Approved !</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="display:flex;justify-content:center">
              <i class="bi bi-check-circle h1" style="color:green"></i>
            </div>
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
  
  <script>
    function modalPopup() {
      var modal = <?php echo $_SESSION['modal']?>;

      if(modal == 1){
      var myModal = new bootstrap.Modal(document.getElementById('approved')); 
      myModal.show();
      }
      
      if(modal == 2){
      var myModal = new bootstrap.Modal(document.getElementById('declined')); 
      myModal.show();
      }

      <?php $_SESSION['modal'] =0;?>
    }
  </script>

</body>

</html>