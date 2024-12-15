<?php
require './database/requests.php';
require './database/databases.php';


session_start();

// Check if the user is already logged in via session
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to dashboard if already logged in
    header("Location: home.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Logged = false;
    $LoginError = false;

    $userType = $_POST['user_type']; // Get the user type ('patient' or 'doctor')
    $email = $_POST['email'];
    $password = $_POST['password'];


    if ($userType === 'patient') {
        // Handle patient login

        if ($password == $Patients->request_if('email',$email)[0]['password']) { //We can do this because email is unique
            $patient = $Patients->request_if('email',$email)[0];
            //Save the session
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $patient['id'];
            $_SESSION['firstname'] = $patient['firstname'];
            $_SESSION['lastname'] = $patient['lastname'];
            header("Location: home.php");
            exit();
        }
        else {
            //Wrong password/user
            $LoginError = true;
        }

    } elseif ($userType === 'doctor') {
        // Handle doctor login

        if ($password == $Doctors->request_if('email',$email)[0]['password']) { //We can do this because email is unique
            $doctor = $Doctors->request_if('email',$email)[0];
            //Save the session
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $doctor['id'];
            $_SESSION['firstname'] = $doctor['firstname'];
            $_SESSION['lastname'] = $doctor['lastname'];
            header("Location: home.php");
            exit();
        }
        else {
            //Wrong password/user
            $LoginError = true;
        }
    }



}

?>



<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="login_style.css" rel="stylesheet">
  <script src="login.js" defer></script>
  <title>Login Page</title>
</head>
<body>
  <div class="container">
    <!-- Left Section -->
    <div class="photo-section">
      <div class="photo-placeholder">Photos</div>
    </div>

    <div class="form-section">
    <!-- Tabs for Patient/Doctor -->
    <div class="tab-container">
        <?php
        // Determine which tab should be active
        $isDoctor = isset($userType) && $userType === 'doctor';
        ?>
        <button class="tab <?php echo !$isDoctor ? 'active' : ''; ?>" onclick="switchTab('patient')">Patient</button>
        <button class="tab <?php echo $isDoctor ? 'active' : ''; ?>" onclick="switchTab('doctor')">Doctor</button>
    </div>

    <!-- Login Form -->
    <form action="login.php" method="POST" class="login-form">
        <h2>Sign in</h2>
        <p>Please enter your account details</p>

        <label for="email">Email or name</label>
        <input type="text" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        <div class="options">
        <input type="checkbox" id="keep-signed-in">
        <label for="keep-signed-in">Keep me signed in</label>
        </div>

        <a href="#" class="forgot-password">Forgot password?</a>

        <!-- Hidden input to track the selected tab -->
        <input type="hidden" id="user-type" name="user_type" value="<?php echo $isDoctor ? 'doctor' : 'patient'; ?>">

        <button type="submit" class="btn">Sign in</button>
        <?php
        if ($LoginError) {
            echo "<div class='error'>Login failed</div>";
        }
        ?>
    </form>
    </div>
  </div>
</body>
</html>