<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'database/requests.php';
include_once 'database/databases.php';
if (!isset($_SESSION['id']) || $_SESSION['loggedin'] !== true || $_SESSION['user_type'] !== 'doctor') {
    header('Location: login.php');
    exit();
}
?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <script src="my_past_appointments.js" defer></script>
    <script src="navbar.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="templatePrincipal">
    <header id="navBarHeader">
        <nav class="navbar navbar-expand-lg " id="navBar">
            <div class="container-fluid" style="z-index: 10; background-color: var(--darkblue);">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">My appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">My past appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">My patients</a>
                        </li>
                    </ul>
                    <ul class="add_appointment">
                        <button class="text" title="click here to add an empty appointment" type="button">+</button>
                        <div class="add_appointment_container">
                            <div class="add_appointment_content">
                                <h1>Add an appointment</h1>
                                <form id="form">
                                    <label for="list1">Choose a day :</label>
                                    <input type="date" id="date">
                                    <br><br>
                                    <label for="list2">Choose a time slot :</label>
                                    <select id="time" name="time">
                                        <option value="default" selected>Chose an option</option>
                                        <!-- instert php request here to get available time slots  for the selected day-->
                                        <?php
                                        echo "tamere";
                                        ?>
                                        <!-- echo "<option value="optionC">". content ."</option>" -->
                                    </select>
                                    <br><br>
                                    <label for="list3">Choose a location :</label>
                                    <select id="location" name="location">
                                        <option value="default" selected>Chose an option</option>
                                        <!-- instert php request here to get available locations-->
                                        <?php

                                        foreach ($Locations->request_all(false, false) as $location) {
                                            echo "<option value=\"location_\"" . $location['name'] . ">" . $location['name'] . " - " . $location['postcode'] . "</option>";
                                        }
                                        ?>
                                        <!-- echo "<option value="optionC">". content ."</option>" -->
                                    </select>
                                    <br><br>
                                    <button type="button" class="validate_add_appointment">Validate</button>
                                </form>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="my_past_appointments">
        <label for="list2">Doctor</label>
        <select id="doctor_my_past_appointments" name="doctor">
            <option value="default" selected>Chose an option</option>

            <?php
            foreach ($Doctors->request_all(false, false) as $doctor) {
                echo "<option value=\"doctor_" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "\">" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "</option>";
            }
            ?>
        </select>
        <label for="list2">Expertise</label>
        <select id="expertise_my_past_appointments" name="expertise">
            <option value="default" selected>Chose an option</option>

            <?php
            foreach ($Expertise->request_all(false, false) as $expertise) {
                echo "<option value=\"expertise_" . $expertise['name'] . "\">" . $expertise['name'] . "</option>";
            }
            ?>
        </select>
        <label for="list3">Location :</label>
        <select id="location_my_past_appointments" name="location">
            <option value="default" selected>Chose an option</option>
            <?php
            foreach ($Locations->request_all(false, false) as $location) {
                echo "<option value=\"location_" . $location['name'] . "\">" . $location['name'] . " - " . $location['postcode'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <table style="border: 1px solid white;" class="table_my_past_appointments">
            <thead>
                <tr>
                    <th style="border: 1px solid white;">Date</th>
                    <th style="border: 1px solid white;">Start Time</th>
                    <th style="border: 1px solid white;">End Time</th>
                    <?php
                    //check if the user is a doctor or a patient
                    ?>
                    <th style="border: 1px solid white;">Doctor</th>
                    <th style="border: 1px solid white;">Patient</th>
                    <th style="border: 1px solid white;">Location</th>
                    <th style="border: 1px solid white;">Expertise</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Rendezvous->request_all(false, false) as $rendezvous) {
                    $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                    $currentDate = new DateTime(); // current date
                    if ($rendezvousDate < $currentDate) {
                        echo "<tr id=\"table_my_past_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_past_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_past_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_past_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>
                                        "/*check if the user is a doctor or a patient*/ . "
                                        <td id=\"my_past_appointments_" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_past_appointments_" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_past_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_past_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer class="footer">
        <a class="nav-link" href="logout.php">Logout</a>
    </footer>
</body>

</html>