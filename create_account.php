

<?php

require './database/requests.php';
require './database/databases.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = false;
    $errorOccured = "";
    $successOccured = "";
    $postcode = null;
    $expertise = null;
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $confirm_email = htmlspecialchars($_POST['confirm_email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $phone = htmlspecialchars($_POST['phone']);

    $user_type = 'patient';
    if(isset($_POST['expertise']) && isset($_POST['postcode'])){
        $expertise = $_POST['expertise'];
        $postcode = $_POST['postcode'];
        $user_type = 'doctor';
    }


    // Basic validations
    if ($email !== $confirm_email) {
        $errorOccured = "Emails do not match!";
    } elseif ($password !== $confirm_password) {
        $errorOccured = "Passwords do not match!";
    } else {
        if($user_type === 'doctor'){
            $datas = $Doctors->request_if('email',$email);
            if($datas == []){
                $toCreate = [
                    "firstname" => $first_name,
                    "lastname" => $last_name,
                    "email" => $email,
                    "phone" => $phone,
                    "password" => $password,
                    "postcode" => $postcode,
                    "expertise_id" => $expertise
                ];

                $res = $Doctors->add_with($toCreate);

                if($res == false){
                  $errorOccured = "The creation failed. Please try later.";
                }
                else{
                  $successOccured = "Account successfully created ! Please <a href='./login.php'>login</a> to access your account";
                }
            }
            else{
                $errorOccured = "An account with this email already exist. Please <a href='./login.php'>login</a> instead";
            }
        }
        elseif($user_type === 'patient'){
            $datas = $Patients->request_if('email',$email);
            if($datas == []){
              $toCreate = [
                "firstname" => $first_name,
                "lastname" => $last_name,
                "email" => $email,
                "phone" => $phone,
                "password" => $password,
            ];

              $res = $Patients->add_with($toCreate);

              if($res == false){
                $errorOccured = "The creation failed. Please try later.";
              }
              else{
                $successOccured = "Account successfully created !. Please <a href='./login.php'>login</a> to access your account";
              }

            }      
            else{
                $errorOccured = "An account with this email already exist. Please <a href='./login.php'>login</a> instead";
            }      
        }

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
                if($successOccured != ""){
                  echo "<div class='success-container'>".$successOccured."</div>";
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
                    
                    foreach($Expertise->request_all(false,false) as $expertise){
                        echo "<option value='".$expertise['id']."'>".$expertise['name']."</option>";
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