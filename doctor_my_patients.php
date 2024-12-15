<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'database/requests.php';
include_once 'database/databases.php';

?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="edt.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <script src="navbar.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
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

    <div class="my_patients">
        <input type="text" placeholder="First name" id="first_name">
        <input type="text" placeholder="Last name" id="last_name">
    </div>

    <footer class="footer">
        <a class="nav-link" href="logout.php">Logout</a>
    </footer>
</body>