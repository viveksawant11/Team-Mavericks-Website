<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Meetings</title>

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
                    <h2> Upcoming Meetings </h2>
                </div>
                <div class="col sideButton align-right">
                    <span><button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#schedule"><i class="bi bi-plus-circle"></i> Schedule</button></span>
                </div>
            </div>
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

                        if ($meeting['meeting_status'] == 0 && $meeting['meeting_approval'] == 1)
                        echo "
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-header bg-primary'></div>
                            <div class='card-body'>
                                <h5 class='card-title'>".$meeting_date."</h5>
                                <p><b>Time:</b> ".$meeting_time."</p>
                                <p><b>Location:</b> ".$meeting['meeting_location']."</p>
                            </div>
                            <div class='card-footer'>
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#scheduledMeeting".$meeting['meeting_srno']."'><i class='bi bi-journals'></i> Details</button>
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editMeeting".$meeting['meeting_srno']."'><i class='bi bi-pencil'></i> Edit</button>
                            </div>
                        </div>

                        <div class='modal fade' id='scheduledMeeting".$meeting['meeting_srno']."' tabindex='-1'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                    <div class='modal-header bg-primary'>
                                        <h5 class='modal-title' style='color:white'>Meeting Details</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='background-color:white; border-radius:8vh'></button>
                                    </div>
                                    <div class='modal-body'>
                                    <p><b>Date:</b> ".$meeting_date."</p>
                                    <p><b>Time:</b> ".$meeting_time."</p>
                                    <p><b>Location:</b> ".$meeting['meeting_location']."</p>
                                    <p><b>Agenda:</b> ".$meeting['meeting_agenda']."</p>
                                    <p><b>Summary:</b> ".$meeting['meeting_summary']."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                ?>

                </div>
            </div>
        </section>

        <div class="pagetitle">
            <h2> Completed Meetings </h2>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="row">

                    <?php
                    foreach ($data['meetings'] as $meeting) {
                    $date = date_create($meeting['meeting_date']);
                    $time = $meeting['meeting_time'];
                    $meeting_date = date_format($date, "jS M Y");
                    $meeting_time = date('h:i a', strtotime($time));

                    if ($meeting['meeting_status'] == 1 && $meeting['meeting_approval'] == 1)
                    echo "
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-header bg-warning'></div>
                            <div class='card-body'>
                            <h5 class='card-title'>".$meeting_date."</h5>
                            <p><b>Time:</b> ".$meeting_time."</p>
                            <p><b>Location:</b> ".$meeting['meeting_location']."</p>
                            </div>
                            <div class='card-footer'>
                                <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#completedMeeting".$meeting['meeting_srno']."'><i class='bi bi-journals'></i> Summary</button>
                            </div>
                        </div>

                        <div class='modal fade' id='completedMeeting".$meeting['meeting_srno']."' tabindex='-1'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                    <div class='modal-header bg-warning'>
                                        <h5 class='modal-title'>Meeting Summary</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='background-color:white; border-radius:8vh'></button>
                                    </div>
                                    <div class='modal-body'>
                                    <p><b>Date:</b> ".$meeting_date."</p>
                                    <p><b>Time:</b> ".$meeting_time."</p>
                                    <p><b>Location:</b> ".$meeting['meeting_location']."</p>
                                    <p><b>Agenda:</b> ".$meeting['meeting_agenda']."</p>
                                    <p><b>Summary:</b> ".$meeting['meeting_summary']."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                        }
                    ?>

                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="schedule" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-addTop">
                        <h5 class="modal-title">Schedule Meeting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style='background-color:#d1d0d0; border-radius:8vh'></button>
                    </div>
                    <div class="modal-body">
                        <form action="apicalls/addMeeting.php" method="POST">
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="meeting_date" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                                <div class="col-sm-10">
                                    <input type="time" name="meeting_time" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" name="meeting_location" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Agenda</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="meeting_agenda" style="height: 100px"></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        foreach ($data['meetings'] as $meeting) {
            if ($meeting['meeting_status'] == 0 && $meeting['meeting_approval'] == 1)
                echo"
                <div class='modal fade' id='editMeeting".$meeting['meeting_srno']."' tabindex='-1'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                            <div class='modal-header bg-primary'>
                                <h5 class='modal-title' style='color:white'>Edit Meeting</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='background-color:white; border-radius:8vh'></button>
                            </div>
                            <div class='modal-body'>
                                <form action='apicalls/updateMeeting.php' method='POST'>
                                    <div class='row mb-3'>
                                        <label for='inputDate' class='col-sm-2 col-form-label'>Date</label>
                                        <div class='col-sm-10'>
                                            <input type='date' name='meeting_date' value=".$meeting['meeting_date']." class='form-control'>
                                        </div>
                                    </div>
                                    <div class='row mb-3'>
                                        <label for='inputTime' class='col-sm-2 col-form-label'>Time</label>
                                        <div class='col-sm-10'>
                                            <input type='time' name='meeting_time' value=".$meeting['meeting_time']." class='form-control'>
                                        </div>
                                    </div>
                                    <div class='row mb-3'>
                                        <label for='inputText' class='col-sm-2 col-form-label'>Location</label>
                                        <div class='col-sm-10'>
                                            <input type='text' name='meeting_location' value='".$meeting['meeting_location']."' class='form-control'>
                                        </div>
                                    </div>
                                    <div class='row mb-3'>
                                        <label for='inputText' class='col-sm-2 col-form-label'>Agenda</label>
                                        <div class='col-sm-10'>
                                            <textarea name='meeting_agenda' class='form-control' style='height: 100px'>".$meeting['meeting_agenda']."</textarea>
                                        </div>
                                    </div>
                                    <div class='row mb-3'>
                                        <label for='inputText' class='col-sm-2 col-form-label'>Summary</label>
                                        <div class='col-sm-10'>
                                            <textarea name='meeting_summary' class='form-control' style='height: 100px'></textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' name='meeting_srno' value=".$meeting['meeting_srno']." class='btn btn-success'>Send request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
        }
        ?>

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