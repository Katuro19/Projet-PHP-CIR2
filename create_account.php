

<?php

require './database/requests.php';
require './database/databases.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorOccured = "";
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $confirm_email = htmlspecialchars($_POST['confirm_email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Basic validations
    if ($email !== $confirm_email) {
        $errorOccured = "Emails do not match!";
    } elseif ($password !== $confirm_password) {
        $errorOccured = "Passwords do not match!";
    } else {
        // Database insertion code here
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="create_account.css">
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h2>Create an account</h2>
      <div class="tab-container">
        <button class="tab active" id="patientTab" onclick="switchForm('patient')">Patient</button>
        <button class="tab" id="doctorTab" onclick="switchForm('doctor')">Doctor</button>
      </div>

      <!-- Patient Form -->
      <form id="patientForm" method="POST" action="create_account.php">
        <div class="name-container">
            <input type="text" name="first_name" placeholder="First name" required>
            <input type="text" name="last_name" placeholder="Last name" required>
        </div>
        <div class = "email-container">
            <input type="email" name="email" placeholder="Email" required>
            <input type="email" name="confirm_email" placeholder="Confirm your email" required>
        </div>
        <div class="ppp-container">
            <input type="text" name="phone" placeholder="Phone number" required>
            <input type="text" name="postcode" placeholder="" style="opacity : 0" disabled="disabled">
        </div>
        <div class="password-container">
          <input type="password" name="password" placeholder="Password" id="patientPassword" required>
          <span class="toggle-password" onclick="togglePassword('patientPassword')">👁️</span>
        </div>
        <div class="password-container">
          <input type="password" name="confirm_password" placeholder="Confirm your password" id="patientConfirmPassword" required>
          <span class="toggle-password" onclick="togglePassword('patientConfirmPassword')">👁️</span>
        </div>
        <button type="submit" class="btn">Create account</button>
        <?php
                if($errorOccured != ""){
                    echo "<div class='error-container'>".$errorOccured."</div>";
                }
            ?>
      </form>

      <!-- Doctor Form -->
      <form id="doctorForm" method="POST" action="create_account.php" style="display: none;">


        <div class="name-container">
            <input type="text" name="first_name" placeholder="First name" required>
            <input type="text" name="last_name" placeholder="Last name" required>
        </div>
        <div class = "email-container">
            <input type="email" name="email" placeholder="Email" required>
            <input type="email" name="confirm_email" placeholder="Confirm your email" required>
        </div>
        <div class="ppp-container">
            <input type="text" name="phone" placeholder="Phone number" required>
            <input type="text" name="postcode" placeholder="Post code" required>
        </div>
        <div class="expert-container" style='display-flex : center'>
                <select name="expertise" required>
                <option value="" disabled selected>Expertise</option>
                <?php 
                    
                    foreach($Expertise->request_all(true,true) as $expertise){
                        echo "<option value='".$expertise['name']."'>".$expertise['name']."</option>";
                      }
                    
                ?>
                </select>
        </div>
        <div class="password-container">
          <input type="password" name="password" placeholder="Password" id="doctorPassword" required>
          <span class="toggle-password" onclick="togglePassword('doctorPassword')">👁️</span>
        </div>
        <div class="password-container">
          <input type="password" name="confirm_password" placeholder="Confirm your password" id="doctorConfirmPassword" required>
          <span class="toggle-password" onclick="togglePassword('doctorConfirmPassword')">👁️</span>
        </div>
        <div class="sub-container">
            <button type="submit" class="btn">Create account</button>
        </div>
      </form>
    </div>
  </div>

  <script src="create_account.js"></script>
</body>
</html>