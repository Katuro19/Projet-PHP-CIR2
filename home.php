<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'database/requests.php';
include_once 'database/databases.php';
if (!isset($_SESSION['id']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="edt.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <script src="my_appointments.js" defer></script>
    <script src="my_past_appointments.js" defer></script>
    <script src="navbar.js" defer></script>
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
    <div id="home">
        <form id="form" name="form" method="post">
            <div id="form:cadreMiseEnPage" class="cadreMiseEnPage">
                <div id="layout-container" class="mode-portail-entete-affiche">
                    <div id="layout-container-row">
                        <div id="layout-portlets-cover" style="margin-left: 0px;">
                            <div id="form:Center">
                                <div class="Container100">
                                    <div class="planning Card"
                                        style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;">
                                        <div id="form:j_idt118" class="schedule">
                                            <div id="form:j_idt118_container" class="fc fc-cursor fc-ltr ui-widget">
                                                <div class="fc-toolbar">
                                                    <div class="fc-center">
                                                        <h2>9 — 15 Décembre 2024</h2>
                                                    </div>
                                                    <div class="fc-clear"></div>
                                                </div>
                                                <div class="fc-view-container">
                                                    <div class="fc-view fc-agendaWeek-view fc-agenda-view">
                                                        <table id="zindex">
                                                            <thead class="fc-head">
                                                                <tr>
                                                                    <td class="fc-head-container ui-widget-header">
                                                                        <div class="fc-row ui-widget-header">
                                                                            <table
                                                                                style="margin-bottom: 0.5%; margin-top: 0.5%;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="fc-axis ui-widget-header"
                                                                                            style="width:30px">
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-09">Mon
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-10">Tue
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-11">Wen
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-12">Thu
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-13">Fri
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-14">Sat
                                                                                        </th>
                                                                                        <th class="ui-widget-header"
                                                                                            data-date="2024-12-15">Sun
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fc-body">
                                                                <tr>
                                                                    <td class="ui-widget-content">
                                                                        <div class="fc-scroller fc-time-grid-container"
                                                                            style="overflow: hidden auto; height: auto;">
                                                                            <div class="fc-time-grid fc-unselectable">
                                                                                <div class="fc-bg">
                                                                                    <table>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="fc-axis ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-09">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-10">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-11">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-12">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-13">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-14">
                                                                                                </td>
                                                                                                <td class="fc-day ui-widget-content"
                                                                                                    data-date="2024-12-15">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="fc-slats">
                                                                                    <table>
                                                                                        <tbody>
                                                                                            <tr data-time="08:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>08</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="08:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="09:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>09</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="09:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="10:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>10</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="10:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="11:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>11</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="11:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="12:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>12</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="12:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="13:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>13</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="13:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="14:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>14</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="14:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="15:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>15</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="15:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="16:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>16</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="16:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="17:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>17</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="17:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="18:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>18</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="18:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="19:00:00">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                    <span>19</span>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr data-time="19:30:00"
                                                                                                class="fc-minor">
                                                                                                <td class="fc-axis fc-time ui-widget-content"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td
                                                                                                    class="ui-widget-content">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="fc-content-skeleton">
                                                                                    <table>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="fc-axis"
                                                                                                    style="width:30px">
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="fc-content-col">
                                                                                                        <div
                                                                                                            class="fc-event-container fc-helper-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-event-container">
                                                                                                            <a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 0px 0% -99.5px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-title">
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-highlight-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-bgevent-container">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="fc-business-container">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><span id="form:j_idt235"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br><br><br><br>
    <div class="my_appointments">
        <form>
            <label for="list1">Date :</label>
            <input type="date" id="date_my_appointments" value="">
            <?php
            if ($_SESSION['user_type'] == 'patient') {
                echo "<label for=\"list2\">Doctor</label>
                    <select id=\"doctor_my_appointments\" name=\"doctor\">
                    <option value=\"default\" selected>Chose an option</option>";
                    foreach ($Doctors->request_all(false, false) as $doctor) {
                        echo "<option value=\"doctor_" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "\">" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "</option>";
                    }
                echo "</select>";
            } else {
                echo "<label for=\"list2\">Patient</label>
                    <select id=\"patient_my_appointments\" name=\"patient\">
                    <option value=\"default\" selected>Chose an option</option>";
                    foreach ($Patients->request_all(false, false) as $patient) {
                        echo "<option value=\"patient_" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "\">" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "</option>";
                    }
                echo "</select>";
            }
            ?>
            <label for="list2">Expertise</label>
            <select id="expertise_my_appointments" name="expertise">
                <option value="default" selected>Chose an option</option>
                <?php
                foreach ($Expertise->request_all(false, false) as $expertise) {
                    echo "<option value=\"expertise_" . $expertise['name'] . "\">" . $expertise['name'] . "</option>";
                }
                ?>
            </select>
            <label for="list3">Location :</label>
            <select id="location_my_appointments" name="location">
                <option value="default" selected>Chose an option</option>
                <?php
                foreach ($Locations->request_all(false, false) as $location) {
                    echo "<option value=\"location_" . $location['name'] . "\">" . $location['name'] . " - " . $location['postcode'] . "</option>";
                }
                ?>
            </select>
            <br><br>
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
                            $currentDate = new DateTime(); // current date
                            if ($rendezvousDate > $currentDate) {
                                echo "<tr id=\"table_my_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>
                                        <td id=\"my_appointments_" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                            }
                        }
                    } else {
                        foreach ($Rendezvous->request_if('patient_id', $_SESSION['id'], false, false) as $rendezvous) {
                            $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                            $currentDate = new DateTime(); // current date
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
        </form>
    </div>
    <br><br><br><br>
    <div class="my_past_appointments">
    <?php
            if ($_SESSION['user_type'] == 'patient') {
                echo "<label for=\"list2\">Doctor</label>
                    <select id=\"doctor_my_past_appointments\" name=\"doctor\">
                    <option value=\"default\" selected>Chose an option</option>";
                    foreach ($Doctors->request_all(false, false) as $doctor) {
                        echo "<option value=\"doctor_" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "\">" . strtoupper($doctor['lastname']) . " " . $doctor['firstname'] . "</option>";
                    }
                echo "</select>";
            } else {
                echo "<label for=\"list2\">Patient</label>
                    <select id=\"patient_my_past_appointments\" name=\"patient\">
                    <option value=\"default\" selected>Chose an option</option>";
                    foreach ($Patients->request_all(false, false) as $patient) {
                        echo "<option value=\"patient_" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "\">" . strtoupper($patient['lastname']) . " " . $patient['firstname'] . "</option>";
                    }
                echo "</select>";
            }
            ?>
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
                        $currentDate = new DateTime(); // current date
                        if ($rendezvousDate < $currentDate) {
                            echo "<tr id=\"table_my_past_appointments_" . $rendezvous['id'] . "\">
                                        <td id=\"my_past_appointments_" . $rendezvous['date'] . "\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['date'] . "</td>
                                        <td id=\"my_past_appointments_start\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['start'] . "</td>
                                        <td id=\"my_past_appointments_end\"style=\"color: black;border: 1px solid white;\">" . $rendezvous['end'] . "</td>
                                        <td id=\"my_past_appointments_" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "\"style=\"color: black;border: 1px solid white;\">" . strtoupper($Patients->request($rendezvous['patient_id'], false, false)['lastname']) . " " . $Patients->request($rendezvous['patient_id'], false, false)['firstname'] . "</td>
                                        <td id=\"my_past_appointments_" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Locations->request($rendezvous['location_id'], false, false)['name'] . "</td>
                                        <td id=\"my_past_appointments_" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "\"style=\"color: black;border: 1px solid white;\">" . $Expertise->request($Doctors->request($rendezvous['doctor_id'], false, false)['expertise_id'], false, false)['name'] . "</td>
                                    </tr>";
                        }
                    }
                } else {
                    foreach ($Rendezvous->request_if('patient_id', $_SESSION['id'], false, false) as $rendezvous) {
                        $rendezvousDate = DateTime::createFromFormat('d/m/Y', $rendezvous['date']);
                        $currentDate = new DateTime(); // current date
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
        <!-- js to dynamicly adjust the visible elements  -->
    </div>
    <br><br><br><br>
    <!-- bonus mdr -->
    <div class="my_patients">
        <input type="text" placeholder="First name" id="first_name">
        <input type="text" placeholder="Last name" id="last_name">
    </div>
    <br><br><br><br>
    <footer class="footer">
        <form action="logout.php" method="POST">
            <br><br>
            <button class="disconnect" type="submit">Logout</button>
        </form>
    </footer>
</body>

</html>