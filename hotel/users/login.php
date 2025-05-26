<?php
session_start();
# database
include("../inc/db.php");

// Include PHPMailer
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['loginEmail']);
    $password = $_POST['loginPassword'];

    # hashing the password
    $password = hash('sha256', $password);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $rs = $con->query($sql);

    if ($rs && $rs->num_rows == 1) {
        // Login successful
        $userData = $rs->fetch_assoc();
        $userName = $userData['name'];
        $userId = $userData['user_id'];

        // Set session variables
        $_SESSION['user_id'] = $userId;
        $_SESSION['name'] = $userName;
        $_SESSION['loggedin'] = true;

        // Redirect to index.php on successful verification
        header("Location: ../index.php");
        exit();
    } else {
        // Login failed
        $loginError = "Invalid email or password";
        if (!$rs) {
            $loginError = "Database error: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reservation System - Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logos.jpg">
    <link rel="stylesheet" href="../assets/css/signup-login.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>
    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <form action="" method="POST" class="form">
            <label>Enter your Email ID:</label>
            <input type="email" id="loginEmail" name="loginEmail" placeholder="username@abc.com" required>
            <label>Enter your Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <?php
            if (isset($loginError)) {
                echo "<p class='error' style='color: red; font-weight: bold;'>$loginError</p>";
            }
            ?>
            <button type="submit" name="login" class="btn btn-success">Login</button>
            <button type="reset" name="reset" class="btn btn-danger">Cancel</button>
            <p class="no-account">Don't have an account? <a href="signup.php">Sign up here</a></p>
            <p class="no-account">Are you an Admin? <a href="../admin/admin_login.php">Admin Login</a></p>
        </form>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>

</body>

</html>