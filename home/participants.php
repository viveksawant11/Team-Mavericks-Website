<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Participants</title>

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

    .table {
      max-width: 100%;
    }

    @media only screen and (max-width: 600px) {
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
          <h2> Participant List </h2>
        </div>
        <div class="col sideButton align-right">
          <button class="btn btn-warning" type="button" style="margin-right:2vh" onclick = "window.location.href='pastParticipants.php';"><i class="bi bi-clock-history"></i> View History</button>
          <button class="btn btn-success" id="btnExport" type="button"><i class="bi bi-file-earmark-arrow-down"></i> Export to CSV</button>
        </div>
      </div>
    </div>

    <section class="section overflow">

      <table class="table" id="table">
        <thead>
          <tr>
            <th>Sr. no.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>College</th>
            <th>Department</th>
            <th>Event</th>
            <th>Payment Proof</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $event = getApi('events');
          $data = json_decode($event, true);
          $serial = 0;
          foreach ($data['events'] as $event) {
            if ($event['event_status'] == 0 && $event['event_approval'] == 1) {
              $resp = getApi('registrations/' . $event['event_srno']);
              $dat = json_decode($resp, true);

              foreach (array_reverse($dat['registrations']) as $registration) {
                $response = getApi('participants/' . $registration['participant_srno']);
                $da = json_decode($response, true);

                foreach ($da['participants'] as $participant) {
                  $serial = $serial + 1;
                  echo "
												<tr>
													<td >" . $serial . "</td>
													<td >" . $participant['participant_name'] . "</td>
													<td >" . $participant['participant_email'] . "</td>
													<td >" . $participant['participant_contact'] . "</td>
                                                    <td >" . $participant['participant_college'] . "</td>
													<td >" . $participant['participant_department'] . "</td>
													<td>" . $event['event_name'] . "</td>
													<td><a href='assets/img/payment/proof" . $participant['participant_srno'] . $event['event_srno'] . $registration['registration_srno'] . ".jpg' target='_blank'>Click here</a></td>
													<td>
												
													</td>
												</tr>";
                }
              }
            }
          }
          ?>

        </tbody>
      </table>

    </section>
  </main><!-- End #main -->

  <?php
  require 'footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/export.js"></script>
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