<?php
  session_start();
  require 'apicalls/apicall.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Events</title>

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
                    <h2> Upcoming Events </h2>
                </div>
                <div class="col sideButton align-right">
                    <span><button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#form"><i class="bi bi-plus-circle"></i> Create</button></span>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row align-items-top">
                <div class="row">

                <?php
                    $eventsResponse = getApi('events');
				    $eventsJson = json_decode($eventsResponse, true);

                    foreach($eventsJson['events'] as $event){
                        if ($event['event_status'] == 0 && $event['event_approval'] == 1){
                            $date = date_create($event['event_date']);
                            $time = $event['event_time'];
                            $event_date = date_format($date, "jS M Y");
                            $event_time = date('h:i a', strtotime($time));

                            $registrationsResponse = getApi('registrations/'.$event['event_srno']);
				            $registrationsJson = json_decode($registrationsResponse, true);

                            echo "
                                <div class='col-md-4'>
                                    <div class='card'>
                                        <div class='card-header bg-primary'></div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$event['event_name']."</h5>
                                            <p><b>Date:</b> ".$event_date."</p>
                                            <p><b>Time:</b> ".$event_time."</p>
                                            <p><b>Location:</b> ".$event['event_location']."</p>
                                            <p><b>Fees:</b> Rs. ".$event['event_fee']."/-</p>
                                        </div>
                                        <div class='card-footer'>
                                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#ongoingEvent".$event['event_srno']."'><i class='bi bi-journals'></i> Details</button>
                                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editEvent".$event['event_srno']."'><i class='bi bi-pencil'></i> Edit</button>
                                        </div>
                                    </div>

                                    <div class='modal fade' id='ongoingEvent".$event['event_srno']."' tabindex='-1'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header bg-primary'>
                                                    <h5 class='modal-title' style='color:white'>Event Details</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='border-radius:8vh; background-color:white'></button>
                                                </div>
                                                <div class='modal-body'>
                                                <p><b>Event Name</b>: ".$event['event_name']."</p>
                                                <p><b>Date:</b> ".$event_date."</p>
                                                <p><b>Time:</b> ".$event_time."</p>
                                                <p><b>Location:</b> ".$event['event_location']."</p>
                                                <p><b>Fees:</b> Rs. ".$event['event_fee']."/-</p>
                                                <p><b>Participants:</b> ".count($registrationsJson['registrations'])."</p>
                                                <p><b>Details:</b> ".$event['event_description']."</p>
                                                </div>
                                            </div>
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
            <h2> Completed Events </h2>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="row">

                    <?php
                    foreach($eventsJson['events'] as $event){
                        if ($event['event_status'] == 1){
                            $date = date_create($event['event_date']);
                            $time = $event['event_time'];
                            $event_date = date_format($date, "jS M Y");
                            $event_time = date('h:i a', strtotime($time));

                            $registrationsResponse = getApi('registrations/'.$event['event_srno']);
				            $registrationsJson = json_decode($registrationsResponse, true);

                                echo "
                            <div class='col-md-4'>
                                <div class='card'>
                                    <div class='card-header bg-warning'></div>
                                    <div class='card-body'>
                                        <h5 class='card-title'>".$event['event_name']."</h5>
                                        <p><b>Date:</b> ".$event_date."</p>
                                        <p><b>Time:</b> ".$event_time."</p>
                                        <p><b>Location:</b> ".$event['event_location']."</p>
                                        <p><b>Fees:</b> Rs. ".$event['event_fee']."/-</p>
                                    </div>
                                    <div class='card-footer'>
                                        <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#completedEvent".$event['event_srno']."'><i class='bi bi-journals'></i> Event Report</button>
                                    </div>
                                </div>

                                <div class='modal fade' id='completedEvent".$event['event_srno']."' tabindex='-1'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header bg-warning'>
                                                <h5 class='modal-title'>Event Report</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='border-radius:8vh; background-color:white'></button>
                                            </div>
                                            <div class='modal-body'>
                                            <p><b>Event Name:</b> ".$event['event_name']."</p>
                                            <p><b>Date:</b> ".$event_date."</p>
                                            <p><b>Time:</b> ".$event_time."</p>
                                            <p><b>Location:</b> ".$event['event_location']."</p>
                                            <p><b>Fees:</b> Rs. ".$event['event_fee']."/-</p>
                                            <p><b>Participants:</b> ".count($registrationsJson['registrations'])."</p>
                                            <p><b>Details:</b> ".$event['event_description']."</p>
                                            </div>
                                        </div>
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
                        <h5 class="modal-title">Create Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style='background-color:#d1d0d0; border-radius:8vh'></button>
                    </div>
                    <div class="modal-body">
                        <form action="apicalls/addEvent.php" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="event_name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="event_date" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                                <div class="col-sm-10">
                                    <input type="time" name="event_time" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" name="event_location" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Details</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="event_description" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Fee</label>
                                <span class="input-group-text">Rs.</span>
                                <input type="text" name="event_fee" class="form-control" aria-label="Amount">
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Payment QR</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="qr" type="file" id="formFile" accept="image/png" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Event Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="image" type="file" id="formFile" accept=".webp" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Brochure</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="brochure" type="file" id="formFile" accept=".pdf" required>
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
        foreach($eventsJson['events'] as $event){
        echo "
        <div class='modal fade' id='editEvent".$event['event_srno']."' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header bg-primary'>
                        <h5 class='modal-title' style='color:white'>Edit Event</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='background-color:white; border-radius:8vh'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='apicalls/updateEvent.php' method='POST' enctype='multipart/form-data'>
                            <div class='row mb-3'>
                                <label for='inputText' class='col-sm-2 col-form-label'>Name</label>
                                <div class='col-sm-10'>
                                    <input type='text' name='event_name' value='".$event['event_name']."' class='form-control'>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputDate' class='col-sm-2 col-form-label'>Date</label>
                                <div class='col-sm-10'>
                                    <input type='date' name='event_date' value=".$event['event_date']." class='form-control'>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputTime' class='col-sm-2 col-form-label'>Time</label>
                                <div class='col-sm-10'>
                                    <input type='time' name='event_time' value=".$event['event_time']." class='form-control'>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputText' class='col-sm-2 col-form-label'>Location</label>
                                <div class='col-sm-10'>
                                    <input type='text' name='event_location' value='".$event['event_location']."' class='form-control'>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputPassword' class='col-sm-2 col-form-label'>Details</label>
                                <div class='col-sm-10'>
                                    <textarea class='form-control' name='event_description' style='height: 100px'>".$event['event_description']."</textarea>
                                </div>
                            </div>
                            <div class='input-group mb-3'>
                                <label for='inputText' class='col-sm-2 col-form-label'>Fee</label>
                                <span class='input-group-text'>Rs.</span>
                                <input type='text' name='event_fee' value='".$event['event_fee']."' class='form-control' aria-label='Amount'>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputNumber' class='col-sm-2 col-form-label'>Payment QR</label>
                                <div class='col-sm-10'>
                                    <input class='form-control' name='qr' type='file' id='formFile' accept='image/png' required>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputNumber' class='col-sm-2 col-form-label'>Event Image</label>
                                <div class='col-sm-10'>
                                    <input class='form-control' name='image' type='file' id='formFile' accept='.webp' required>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <label for='inputNumber' class='col-sm-2 col-form-label'>Brochure</label>
                                <div class='col-sm-10'>
                                    <input class='form-control' name='brochure' type='file' id='formFile' accept='.pdf' required>
                                </div>
                            </div>
                            <div class='row mb-3'>
                                <div class='form-check'>
                                    <input class='form-check-input' name='event_status' value='0' type='checkbox' style='margin-left:1vh'>
                                    <label class='form-check-label' for='gridCheck2' style='margin-left:1vh'>Mark Completed</label>
                                </div>
                            </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' name='event_srno' value='".$event['event_srno']."' class='btn btn-success'>Send request</button>
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
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>