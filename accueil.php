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
                                <!-- <span class="close">&times;</span> -->
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

                                        foreach($Locations->request_all(false,false) as $location){
                                            echo "<option value=\"location_\"".$location['name'].">".$location['name']." - ". $location['postcode']."</option>";
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 112px 0% -212px; z-index: 1; width: auto; height: auto;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 274.5px 0% -374.5px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="fc-bg">
                                                                                                                </div>
                                                                                                            </a><a
                                                                                                                class="fc-time-grid-event fc-v-event fc-event fc-start fc-end COURS"
                                                                                                                title="Voir"
                                                                                                                style="inset: 387px 0% -487px; z-index: 1;">
                                                                                                                <div
                                                                                                                    class="fc-content">
                                                                                                                    <div
                                                                                                                        class="fc-title">
                                                                                                                    </div>
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
    <div class="my_appointments">
        <?php

        ?>



        <from>
            <label for="list1">Choose a day :</label>
            <input type="date" id="date_my_appointments" value="">
            <!-- js to catch the curently selected value -->
            <label for="list2">Chose a doctor</label>
            <select id="doctor" name="doctor">
                <option value="default" selected>Chose an option</option>
            
            <?php
                foreach($Doctors->request_all(false,false) as $doctor){
                    echo "<option value=\"doctor_\"".$doctor['name'].">".strtoupper($doctor['lastname'])." ".$doctor['firstname']."</option>";
                }
            ?>
            </select>
            <label for="list2">Chose an expertise</label>
            <select id="expertise" name="expertise">
                <option value="default" selected>Chose an option</option>
            
            <?php
                foreach($Expertise->request_all(false,false) as $expertise){
                    echo "<option value=\"expertise_\"".$expertise['name'].">".$expertise['name']."</option>";
                }
            ?>
            </select>
            <label for="list3">Choose a location :</label>
            <select id="location" name="location">
                <option value="default" selected>Chose an option</option>
            
            <?php
                foreach($Locations->request_all(false,false) as $location){
                    echo "<option value=\"location_\"".$location['name'].">".$location['name']." - ". $location['postcode']."</option>";
                }
            ?>
            </select>
            <!-- js to dynamicly adjust the visible elements  -->
        </from>
    </div>
    <div class="my_past_appointments">
        <label for="list2">Chose a doctor</label>
        <select id="doctor" name="doctor">
            <option value="default" selected>Chose an option</option>
        </select>
        <?php

        ?>
        <label for="list2">Chose an expertise</label>
        <select id="expertise" name="expertise">
            <option value="default" selected>Chose an option</option>
        </select>
        <?php

        ?>
        <label for="list3">Choose a location :</label>
        <select id="location" name="location">
            <option value="default" selected>Chose an option</option>
        </select>
        <?php

        ?>
        <!-- js to dynamicly adjust the visible elements  -->
    </div>
    <div class="my_patients">
        <input type="text" placeholder="First name" id="first_name">
        <input type="text" placeholder="Last name" id="last_name">
    </div>

    <footer class="footer">
        <a class="nav-link" href="logout.php">Logout</a>
    </footer>
</body>

</html>