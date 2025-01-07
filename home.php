<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'database/requests.php';
include_once 'database/databases.php';
// Check if the user is already logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choosen_doctor = null;
    $date_add_appointment = null;
    $errorGettingAnAppointement = true;
    $selected_location = null;
    $date_chosen = null;
    $start_time = null;
    $end_time = null;
    $user_type = $_SESSION['user_type'];

    if ($user_type === 'doctor') {
        $date_add_appointment = $_POST['date_add_appointment'];
        //Here i need to work a bit on the date
        $date_split = explode("-", $date_add_appointment);
        $date_add_appointment = $date_split[2] . "/" . $date_split[1] . "/" . $date_split[0];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
    } elseif ($user_type === 'patient' && $_POST['doctor'] != "default" && $_POST['time_period'] != 'default') {
        $choosen_doctor = explode("_", $_POST['doctor'])[1]; //since the doctor in the list are written like this : doctor_ID, im taking the last part
        $date_chosen = explode(" ", $_POST['time_period']); // ( [0] => 14:34 [1] => - [2] => 16:34 [3] => 28/12/2024 )  look like this
    }

    if ($_POST['location'] != "default")
        $selected_location = explode("_", $_POST['location'])[1];

    //echo $choosen_doctor . "/" . $date_add_appointment . "/" . $selected_location . "/" . print_r($date_chosen) . "/" . $start_time . "/" . $end_time;


    function validRendezVous($Rendezvous, $date, $start, $end, $patient_id, $doctor_id, $location_id)
    { //check if the rendezvous is valid (exist, and no patient already)
        $allAppointementsExisting = $Rendezvous->request_all();
        foreach ($allAppointementsExisting as $appointment) {
            // we check every appointement to see if it exist
            if (
                $appointment['date'] === $date &&
                $appointment['start'] === $start &&
                $appointment['end'] === $end &&
                ($patient_id === "" || $appointment['patient_id'] === $patient_id) &&
                $appointment['doctor_id'] == $doctor_id &&
                $appointment['location_id'] == $location_id
            ) {

                return $appointment['id'];
            }
        }

        return -1;
    }



    if ($user_type === 'doctor' && $date_add_appointment != null && $selected_location != null) {
        $the_rendezvous = [
            'date' => $date_add_appointment,
            'start' => $start_time,
            'end' => $end_time,
            'doctor_id' => $_SESSION['id'],
            'location_id' => $selected_location
        ];
        $Rendezvous->add_with($the_rendezvous); //Here we should check if the doctor dont already have an appointement. But i'm lazy
    } elseif ($user_type === 'patient' && $choosen_doctor != null && $date_chosen != null) {
        $isValid = validRendezVous($Rendezvous, $date_chosen[3], $date_chosen[0], $date_chosen[2], null, $choosen_doctor, $selected_location);
        if ($isValid != -1) {
            $Rendezvous->change_if($isValid, 'patient_id', $_SESSION['id']);
        } else
            $errorGettingAnAppointement = true;
    }
}
?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="edt.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <script src="my_poc.js" defer></script>
    <script src="my_appointments.js" defer></script>
    <script src="my_past_appointments.js" defer></script>
    <script src="add_get_appointment.js" defer></script>
    <script src="navbar.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="templatePrincipal">
    <script>
        const user_type = <?php echo json_encode($_SESSION['user_type']); ?>;
        const user_element = document.createElement('div');
        document.body.appendChild(user_element);
        user_element.id = "user_type";
        user_element.innerHTML = user_type;
        user_element.style.display = 'none';
    </script>
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
                            <a class="nav-link"><?php
                            if ($_SESSION['user_type'] == 'doctor') {
                                echo "Welcome Dr. " . strtoupper($_SESSION['lastname']) . " " . $_SESSION['firstname'];
                            } else {
                                echo "Welcome " . strtoupper($_SESSION['lastname']) . " " . $_SESSION['firstname'];
                            }

                            ?></a>
                        </li>
                    </ul>
                    <ul class="add_appointment">
                        <?php
                        if ($_SESSION['user_type'] == 'doctor') {
                            echo "<button class=\"text\" title=\"click here to add an empty appointment\" type=\"button\">+</button>";
                        } else {
                            echo "<button class=\"text\" title=\"click here to make an appointment\" type=\"button\">+</button>";
                        }
                        ?>


                        <div class="add_appointment_container">
                            <div class="add_appointment_content">
                                <h1>Add an appointment</h1>
                                <form id="form" method="POST" action="home.php">

                                    <?php if ($_SESSION["user_type"] !== "doctor") {
                                        echo "<label id=\"available_expertises\">Choose an expertise :</label>
                                              <select id=\"selected_available_expertise\" name=\"doctor\" required>
                                              <option value=\"default\" selected>Choose an option</option>";
                                        $available_expertise = $Rendezvous->request_if_null("patient_id");
                                        $currentDate = new DateTime();
                                        $available_expertise_id = [];
                                        foreach ($available_expertise as $expertise) {
                                            
                                            $available_rendez_vous_Date = DateTime::createFromFormat('d/m/Y', $expertise['date']);
                                            if ($available_rendez_vous_Date >= $currentDate) {
                                                array_push($available_expertise_id, $expertise['doctor_id']);
                                            }
                                        }
                                        $available_expertise_id = array_unique($available_expertise_id);

                                        foreach ($available_expertise_id as $expertise) {
                                            echo "<option value=\"doctor_" . $expertise . "\">" . $Expertise->request($Doctors->request($expertise, false, false)['expertise_id'], false, false)['name'] . "</option>";
                                        }
                                        echo "</select><br><br>";
                                    }
                                    ?>

                                    <?php if ($_SESSION["user_type"] == "doctor") {
                                        echo "<label>Choose a day :</label>
                                              <input type=\"date\" id=\"date_add_appointment\" name='date_add_appointment'required>";
                                    } else {
                                        echo "<label id=\"available_doctors\">Choose a doctor :</label>
                                              <select id=\"selected_available_doctor\" name=\"doctor\" required>
                                              <option value=\"default\" selected>Choose an option</option>";
                                        $available_doctors = $Rendezvous->request_if_null("patient_id");
                                        $currentDate = new DateTime();
                                        $available_doctors_id = [];
                                        foreach ($available_doctors as $doctor) {
                                            $available_rendez_vous_Date = DateTime::createFromFormat('d/m/Y', $doctor['date']);
                                            if ($available_rendez_vous_Date >= $currentDate) {
                                                array_push($available_doctors_id, $doctor['doctor_id']);
                                            }
                                        }
                                        $available_doctors_id = array_unique($available_doctors_id);
                                        foreach ($available_doctors_id as $doctors) {
                                            echo "<option value=\"doctor_" . $doctors . "\">" . $Doctors->request($doctors)['lastname'] . " " . $Doctors->request($doctors)['firstname'] . "</option>";
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                    <br><br>
                                    <label id="available_locations">Choose a location :</label>
                                    <select id="selected_available_location" name="location" required>
                                        <option value="default" selected>Choose an option</option>
                                        <?php
                                        foreach ($Locations->request_all(false, false) as $location) {
                                            echo "<option name='choosen_location' value=\"location_" . $location['id'] . "\">" . $location['name'] . " - " . $location['postcode'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <br><br>
                                    <label>Choose a time slot :</label>
                                    <?php
                                    if ($_SESSION['user_type'] == 'doctor') {
                                        echo "<input type=\"time\" id=\"start_time\" name=\"start_time\" required>
                                                  <input type=\"time\" id=\"end_time\" name=\"end_time\" required>";
                                    } else {
                                        echo "<select id=\"patient_available_appointments\" name=\"time_period\" required>
                                              <option value=\"default\" selected>Choose an option</option>";
                                        foreach ($Rendezvous->request_if_null("patient_id") as $available_rendez_vous) {
                                            $available_rendez_vous_Date = DateTime::createFromFormat('d/m/Y', $available_rendez_vous['date']);
                                            $currentDate = new DateTime();
                                            if ($available_rendez_vous_Date >= $currentDate) {
                                                echo "<option id=\"appointment_" . $available_rendez_vous['id'] . "\" class=\"doctor_" . $available_rendez_vous['doctor_id'] . "-location_" . $available_rendez_vous['location_id'] . "\">" . $available_rendez_vous['start'] . " - " . $available_rendez_vous['end'] . " " . $available_rendez_vous['date'] . "</option>";
                                            }
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                    <br><br>
                                    <button type="submit" class="validate_add_appointment">Validate</button>
                                </form>
                            </div>
                        </div>
                    </ul>
                    <ul class="disconnect-container">
                        <form action="logout.php" method="POST">
                            <button class="disconnect" type="submit">
                                <h2>Logout</h2>
                            </button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id='superCalendar'>
        <?php
        if ($_SESSION['user_type'] == 'doctor')
            $allAppointements = $Rendezvous->request_if('doctor_id', $_SESSION['id']);
        else
            $allAppointements = $Rendezvous->request_if('patient_id', $_SESSION['id']);

        $allLoc = $Locations->request_all();
        $allPatients = $Patients->request_all();
        $allDoctors = $Doctors->request_all();


        ?>
        <script>
            const allAppointements = <?php echo json_encode($allAppointements); ?>;
            const allLoc = <?php echo json_encode($allLoc); ?>;
            const allPatients = <?php echo json_encode($allPatients); ?>;
            const allDoctors = <?php echo json_encode($allDoctors); ?>;


            /* Configuration variables */
            const HOURS = 14; // Total slots from 8:00 to 21:00 (each row = 30min slot)
            const START_HOUR = 8; // Starting hour
            const DAYS = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            const TIME_SLOT_HEIGHT = 40; // Height in pixels for each time slot row

            const calendarContainer = document.getElementById("superCalendar");

            // Function to create the grid layout of the calendar
            function createCalendar() {
                // First row: Day headers
                const emptyHeader = document.createElement("div");
                emptyHeader.classList.add("day-header");
                calendarContainer.appendChild(emptyHeader); // Top-left empty corner

                DAYS.forEach(day => {
                    const dayHeader = document.createElement("div");
                    dayHeader.classList.add("day-header");
                    dayHeader.textContent = day;
                    calendarContainer.appendChild(dayHeader);
                });

                // Time slots: Hours and grid cells
                for (let hour = START_HOUR; hour < START_HOUR + HOURS; hour++) {
                    // Hour label column
                    const hourLabel = document.createElement("div");
                    hourLabel.classList.add("hour-label");
                    hourLabel.textContent = `${String(hour).padStart(2, '0')}:00`;
                    calendarContainer.appendChild(hourLabel);

                    // Create time slots for each day
                    for (let day = 0; day < 7; day++) {
                        const timeSlot = document.createElement("div");
                        timeSlot.classList.add("time-slot");
                        timeSlot.dataset.day = day;
                        timeSlot.dataset.hour = hour;
                        calendarContainer.appendChild(timeSlot);
                    }
                }
            }

            // Function to add an appointment dynamically
            function addAppointment(dayIndex, startHour, startMinute, endHour, endMinute, title) {

                // Calculate the top position based on the start time
                let startOffset = 33.4 * (startMinute) / 60;
                const duration = 41.7 * ((endHour - startHour) + (endMinute - startMinute) / (60));   //38.5 is a size in px. Yes we are using pixel. Yes i do want to die

                // Find the appropriate time slot container (to position the appointment within it)
                const timeSlot = document.querySelector(`.time-slot[data-day='${dayIndex}'][data-hour='${Math.floor(startHour)}']`);
                if (timeSlot) {
                    // Create the appointment element
                    const appointment = document.createElement("div");
                    appointment.classList.add("appointment");
                    //console.log(startOffset + " : " + duration);
                    // Set the position of the appointment within the time slot
                    appointment.style.top = `${startOffset}px`; // Adjust position for minutes
                    appointment.style.height = `${duration}px`; // Adjust height for the event duration
                    appointment.textContent = title;

                    // Append the appointment to the correct time slot
                    timeSlot.appendChild(appointment);
                }
            }

            // Initialize the calendar
            createCalendar();
            for (let i = 0; i < allAppointements.length; i++) {
                let currentAppointement = allAppointements[i];
                //console.log(allAppointements[i]);
                if (isInCurrentWeek(currentAppointement['date'])) {
                    let appId = currentAppointement['id'];
                    let dateIndex = getDayNumber(currentAppointement['date']);
                    let startHour = splitTime(currentAppointement['start'])[0];
                    let startMin = splitTime(currentAppointement['start'])[1];
                    let endHour = splitTime(currentAppointement['end'])[0];
                    let endMin = splitTime(currentAppointement['end'])[1];
                    let locationName = findById(allLoc, currentAppointement['location_id']);
                    let appDoctor = findById(allDoctors, currentAppointement['doctor_id']);
                    let appPatient = findById(allPatients, currentAppointement['patient_id']);
                    if (appPatient == null) {
                        addAppointment(dateIndex, startHour, startMin, endHour, endMin, "Location : " + locationName['name'] + " with Doctor : " + appDoctor['lastname'] + ". No patient yet.");
                    }
                    else {
                        addAppointment(dateIndex, startHour, startMin, endHour, endMin, "Location : " + locationName['name'] + " with Doctor : " + appDoctor['lastname'] + "\nPatient : " + appPatient['lastname']);
                    }
                }
                else {
                    //console.log("not in week ");
                }
            }

            /*
            Example of adding an appointment dynamically:
            addAppointment(dayIndex, startHour, startMinute, endHour, endMinute, "Title");
            - dayIndex: 0 (Monday) to 6 (Sunday)
            - startHour and endHour: Hour in 24-hour format
            - startMinute and endMinute
    
    
            //exemple
            addAppointment(0, 8, 30, 10, 0, "Meeting with Team");
            addAppointment(2, 14, 0, 15, 30, "Client Call");
            addAppointment(4, 17, 0, 18, 30, "Project Review");
            addAppointment(5, 10, 0, 12, 30, "Brainstorming Session");
            */

            function getDayNumber(dateStr) {
                // Split the date string (DD/MM/YYYY)
                const [day, month, year] = dateStr.split('/');

                // Create a new Date object (months are 0-based, so subtract 1 from month)
                const date = new Date(year, month - 1, day);

                // getDay() returns 0 (Sunday) to 6 (Saturday), so adjust to make Monday = 0
                let dayNumber = date.getDay();

                // Adjust so that Monday is 0, Sunday is 6
                dayNumber = (dayNumber === 0) ? 6 : dayNumber - 1;

                return dayNumber;
            }



            function splitTime(timeStr) {
                // Split the time string by the colon (":")
                const [hour, minute] = timeStr.split(':').map(Number);

                // Return the array of integers
                return [hour, minute];
            }


            function isInCurrentWeek(dateStr) {
                // Get the current date and set time to midnight
                const currentDate = new Date();
                currentDate.setHours(0, 0, 0, 0);

                // Get the current week's start date (Monday)
                const dayOfWeek = currentDate.getDay(); // Sunday = 0, Monday = 1, ..., Saturday = 6
                const diffToMonday = dayOfWeek === 0 ? -6 : 1 - dayOfWeek; // Adjust if Sunday
                const startOfWeek = new Date(currentDate);
                startOfWeek.setDate(currentDate.getDate() + diffToMonday);

                // Get the current week's end date (Sunday)
                const endOfWeek = new Date(startOfWeek);
                endOfWeek.setDate(startOfWeek.getDate() + 6);

                // Parse the input date (DD/MM/YYYY)
                const [day, month, year] = dateStr.split('/');
                const givenDate = new Date(year, month - 1, day);
                givenDate.setHours(0, 0, 0, 0); // Reset the time for consistency

                // Compare the given date with the start and end of the current week
                return givenDate >= startOfWeek && givenDate <= endOfWeek;
            }

            function findById(array, id) {
                // Use the find method to search the array of dictionaries for the object with the matching id
                return array.find(item => item.id === id);
            }
        </script>
    </div>

    <br><br>


    <div class="all_appointments_stuff">
        <div class="my_appointments">
            <h2 style="padding-bottom: 10px">My appointments</h2>
            <form>
                <label>Date :</label>
                <input type="date" id="date_my_appointments" value="">
                <?php
                if ($_SESSION['user_type'] == 'patient') {
                    echo "<label >Doctor</label>
                    <select id=\"doctor_my_appointments\" name=\"doctor\" style=\"margin-right: 10px\">
                    <option value=\"default\" selected>Choose an option</option>";
                    foreach ($Doctors->request_all(false, false) as $doctor) {
                        echo "<option value=\"doctor_" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "\">" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<label >Patient</label>
                    <select id=\"patient_my_appointments\" name=\"patient\" style=\"margin-right: 10px\">
                    <option value=\"default\" selected>Choose an option</option>";
                    foreach ($Patients->request_all(false, false) as $patient) {
                        echo "<option value=\"patient_" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "\">" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "</option>";
                    }
                    echo "</select>";
                }
                ?>
                <label>Expertise</label>
                <select id="expertise_my_appointments" name="expertise" style="margin-right: 10px">
                    <option value="default" selected>Choose an option</option>
                    <?php
                    foreach ($Expertise->request_all(false, false) as $expertise) {
                        echo "<option value=\"expertise_" . $expertise['name'] . "\">" . $expertise['name'] . "</option>";
                    }
                    ?>
                </select>
                <label>Location :</label>
                <select id="location_my_appointments" name="location" style="margin-right: 10px">
                    <option value="default" selected>Choose an option</option>
                    <?php
                    foreach ($Locations->request_all(false, false) as $location) {
                        echo "<option value=\"location_" . $location['name'] . "\">" . $location['name'] . " - " . $location['postcode'] . "</option>";
                    }
                    ?>
                </select>
            </form>
            <br>
            <table style="border: 1px solid white;" class="table_my_appointments">
                <thead>
                    <tr>
                        <th style="border: 1px solid white;">Date</th>
                        <th style="border: 1px solid white;">Start Time</th>
                        <th style="border: 1px solid white;">End Time</th>
                        <?php
                        if ($_SESSION['user_type'] == 'doctor') {
                            echo "<th style=\"border: 1px solid white;\">Patient</th>";
                        } else {
                            echo "<th style=\"border: 1px solid white;\">Doctor</th>";
                        }
                        ?>
                        <th style="border: 1px solid white;">Location</th>
                        <th style="border: 1px solid white;">Expertise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['user_type'] == 'doctor') {
                        foreach ($Rendezvous->request_if('doctor_id', $_SESSION['id'], false, false) as $rendezvous) {
                            $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                            $currentDate = new DateTime();
                            if ($rendezvousDate > $currentDate) {
                                echo "<tr id=\"table_my_past_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_past_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_past_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_past_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>";
                                if ($Patients->request($rendezvous['patient_id']) != null) {
                                    echo "<td id=\"my_past_appointments_" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "</td>";
                                } else {
                                    echo "<td id=\"my_past_appointments_null\"style=\"color: black;border: 1px solid white;\"> NONE </td>";
                                }
                                echo "<td id=\"my_past_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_past_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                            }
                        }
                    } else {
                        foreach ($Rendezvous->request_if('patient_id', $_SESSION['id'], false, false) as $rendezvous) {
                            $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                            $currentDate = new DateTime();
                            if ($rendezvousDate > $currentDate) {
                                echo "<tr id=\"table_my_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>
                                        <td id=\"my_appointments_" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="my_past_appointments">
            <h2 style="padding-bottom: 10px">My past appointments</h2>
            <form style>
                <?php
                if ($_SESSION['user_type'] == 'patient') {
                    echo "<label>Doctor</label>
                    <select id=\"doctor_my_past_appointments\" name=\"doctor\" style=\"margin-right: 10px\">
                    <option value=\"default\" selected>Choose an option</option>";
                    foreach ($Doctors->request_all(false, false) as $doctor) {
                        echo "<option value=\"doctor_" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "\">" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<label>Patient</label>
                    <select id=\"patient_my_past_appointments\" name=\"patient\" style=\"margin-right: 10px\">
                    <option value=\"default\" selected>Choose an option</option>";
                    foreach ($Patients->request_all(false, false) as $patient) {
                        echo "<option value=\"patient_" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "\">" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "</option>";
                    }
                    echo "</select>";
                }
                ?>
                <label>Expertise</label>
                <select id="expertise_my_past_appointments" name="expertise" style="margin-right: 10px">
                    <option value="default" selected>Choose an option</option>

                    <?php
                    foreach ($Expertise->request_all(false, false) as $expertise) {
                        echo "<option value=\"expertise_" . $expertise['name'] . "\">" . $expertise['name'] . "</option>";
                    }
                    ?>
                </select>
                <label>Location :</label>
                <select id="location_my_past_appointments" name="location" style="margin-right: 10px">
                    <option value="default" selected>Choose an option</option>
                    <?php
                    foreach ($Locations->request_all(false, false) as $location) {
                        echo "<option value=\"location_" . $location['name'] . "\">" . $location['name'] . " - " . $location['postcode'] . "</option>";
                    }
                    ?>
                </select>
            </form>
            <br>
            <table style="border: 1px solid white;" class="table_my_past_appointments">
                <thead>
                    <tr>
                        <th style="border: 1px solid white;">Date</th>
                        <th style="border: 1px solid white;">Start Time</th>
                        <th style="border: 1px solid white;">End Time</th>
                        <?php
                        if ($_SESSION['user_type'] == 'doctor') {
                            echo "<th style=\"border: 1px solid white;\">Patient</th>";
                        } else {
                            echo "<th style=\"border: 1px solid white;\">Doctor</th>";
                        }
                        ?>
                        <th style="border: 1px solid white;">Location</th>
                        <th style="border: 1px solid white;">Expertise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['user_type'] == 'doctor') {
                        foreach ($Rendezvous->request_if('doctor_id', $_SESSION['id'], false, false) as $rendezvous) {
                            $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                            $currentDate = new DateTime();
                            if ($rendezvousDate < $currentDate) {
                                echo "<tr id=\"table_my_past_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_past_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_past_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_past_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>";
                                if ($Patients->request($rendezvous['patient_id']) != null) {
                                    echo "<td id=\"my_past_appointments_" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "</td>";
                                } else {
                                    echo "<td id=\"my_past_appointments_null\"style=\"color: black;border: 1px solid white;\"> NONE </td>";
                                }
                                echo "<td id=\"my_past_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_past_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                            }
                        }
                    } else {
                        foreach ($Rendezvous->request_if('patient_id', $_SESSION['id'], false, false) as $rendezvous) {
                            $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                            $currentDate = new DateTime();
                            if ($rendezvousDate < $currentDate) {
                                echo "<tr id=\"table_my_past_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_past_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_past_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_past_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>
                                        <td id=\"my_past_appointments_" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Doctors->request($rendezvous['doctor_id'], false, false)['lastname']) . " " . $Doctors->request($rendezvous['doctor_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_past_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_past_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="my_poc">
            <?php
            if ($_SESSION['user_type'] == 'doctor') {
                echo "<h2 style=\"padding-bottom: 10px\">My patients</h2>
            <div id=\"my_patients\">
                <input type=\"text\" placeholder=\"Last name\" id=\"last_name\" style=\"margin-right: 10px\">
                <input type=\"text\" placeholder=\"First name\" id=\"first_name\">
            </div>
            <br>
            <table class=\"table_my_poc\">
                <thead>
                    <tr>
                        <th style=\"border: 1px solid white;\">Lastname</th>
                        <th style=\"border: 1px solid white;\">Firstname</th>
                        <th style=\"border: 1px solid white;\">Email</th>
                        <th style=\"border: 1px solid white;\">Phone number</th>
                    </tr>
                </thead>
                <tbody>";
                $my_patients = $Rendezvous->request_if('doctor_id', $_SESSION['id'], false, false);
                $patients_id = [];
                foreach ($my_patients as $my_patient) {
                    if ($my_patient['patient_id'] != null) {
                        array_push($patients_id, $my_patient['patient_id']);
                    }
                }
                $patients_id = array_unique($patients_id);
                foreach ($patients_id as $id) {
                    $patient = $Patients->request($id, false, false);
                    echo "<tr class=\"my_poc_table\">
                    <td id=\"my_poc_lastname_" . strtoupper($patient['lastname']) . "\" style=\"color: black;border: 1px solid white;\">" . strtoupper($patient['lastname']) . "</td>
                    <td id=\"my_poc_firstname_" . $patient['firstname'] . "\" style=\"color: black;border: 1px solid white;\">" . $patient['firstname'] . "</td>
                    <td style=\"color: black;border: 1px solid white;\">" . $patient['email'] . "</td>
                    <td style=\"color: black;border: 1px solid white;\">" . $patient['phone'] . "</td>
                </tr>";
                }
            } else {
                echo "<h2 style=\"padding-bottom: 10px\">My doctors</h2>
                <h3>Select a doctor to see the available appointements.</h3>

            <div id=\"my_doctors\" >
                <input type=\"text\" placeholder=\"Last name\" id=\"last_name\" style=\"margin-right: 10px\">
                <input type=\"text\" placeholder=\"First name\" id=\"first_name\">
            </div>
            <br>
            <table class=\"table_my_poc\">
            <thead>
                <tr>
                    <th style=\"border: 1px solid white;\">Lastname</th>
                    <th style=\"border: 1px solid white;\">Firstname</th>
                    <th style=\"border: 1px solid white;\">Email</th>
                    <th style=\"border: 1px solid white;\">Phone number</th>
                </tr>
            </thead>
            <tbody>";
                $my_doctors = $Rendezvous->request_if('patient_id', $_SESSION['id'], false, false);
                $doctors_id = [];
                foreach ($my_doctors as $my_doctor) {
                    array_push($doctors_id, $my_doctor['doctor_id']);
                }
                $doctors_id = array_unique($doctors_id);
                foreach ($doctors_id as $id) {
                    $doctor = $Doctors->request($id);
                    echo "<tr class=\"my_poc_table\">
                    <td class=\"canBeClicked\" id=\"my_poc_lastname_" . strtoupper($doctor['lastname']) . "_" . $doctor['id'] . "\" style=\"color: black;border: 1px solid white;\">" . strtoupper($doctor['lastname']) . "</td>
                    <td class=\"canBeClicked\" id=\"my_poc_firtsname_" . $doctor['firstname'] . "_" . $doctor['id'] . "\" style=\"color: black;border: 1px solid white;\">" . $doctor['firstname'] . "</td>
                    <td style=\"color: black;border: 1px solid white;\">" . $doctor['email'] . "</td>
                    <td style=\"color: black;border: 1px solid white;\">" . $doctor['phone'] . "</td>
                </tr>";
                }
            }
            ?>
            </tbody>
            </table>
        </div>
    </div>
    <footer class="footer">
    </footer>
</body>

</html>