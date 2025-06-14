<?php
# database
include("../inc/db.php");

$reservationSuccess = false;
$reservationError = "";
$selectedHome = null;

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Check if the form data has been submitted
if (isset($_GET['home_id'])) {
    $user_id = $_SESSION['user_id'];
    $homeId = $_GET['home_id'];

    // Fetch selected home's information
    $query = "SELECT * FROM holiday_homes WHERE home_id = $homeId";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        $selectedHome = $result->fetch_assoc();
    } else {
        $reservationError = "Selected home not found.";
    }
}

// Fetch the check-in and check-out dates from the query parameters
$checkIn = isset($_GET['checkIn']) ? $_GET['checkIn'] : "";
$checkOut = isset($_GET['checkOut']) ? $_GET['checkOut'] : "";

// Check if the reservation form has been submitted
if (isset($_POST['home_id'], $_POST['checkIn'], $_POST['checkOut'])) {
    $homeId = $_POST['home_id'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $curr_date = date("Y-m-d");

    if (strtotime($checkIn) < strtotime($curr_date) || strtotime($checkOut) < strtotime($curr_date)) {
        $reservationError = "Check-in date or check-out date are lesser than current date.";
    } else {

        // Check if check-in date is greater than check-out date
        if (strtotime($checkIn) > strtotime($checkOut)) {
            $reservationError = "Check-in date cannot be greater than the check-out date.";
        } else {
            // Calculate total price based on selected home's price and booking duration
            $query = "SELECT price FROM holiday_homes WHERE home_id = $homeId";
            $result = $con->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $price = $row['price'];
                $bookingDuration = strtotime($checkOut) - strtotime($checkIn);
                $totalPrice = ($bookingDuration / (60 * 60 * 24)) * $price;

                // Insert reservation into the database
                $insertQuery = "INSERT INTO reservations (user_id, home_id, check_in_date, check_out_date, total_price) 
                            VALUES ($user_id, $homeId, '$checkIn', '$checkOut', $totalPrice)";
                $insertResult = $con->query($insertQuery);

                if ($insertResult) {
                    // Successful reservation
                    $reservationSuccess = true;

                    // Update the availability_status to "not_available"
                    $updateAvailabilityQuery = "UPDATE holiday_homes SET availability_status = 'not_available' WHERE home_id = $homeId";
                    $updateAvailabilityResult = $con->query($updateAvailabilityQuery);

                    if (!$updateAvailabilityResult) {
                        // Handle the update error if needed
                        $reservationError = "Error updating availability status: " . $con->error;
                    } else {
                        // Redirect to reservations.php after successful reservation
                        header("Location: reservations.php");
                    }
                } else {
                    $reservationError = "Error creating reservation: " . $con->error;
                }
            } else {
                $reservationError = "Error fetching home price: " . $con->error;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reserve - Reservation System</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logos.jpg">
    <link rel="stylesheet" href="../assets/css/reserve.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>
    <!-- Nav Bar -->
    <?php include("../inc/header.php"); ?>

    <div class="container">
        <?php
        if ($selectedHome) {
            echo "<div class='holiday-home'>";
            echo "<img src='{$selectedHome['image_path']}' alt='{$selectedHome['name']}' class='home-image'>";
            echo "<div class='holiday-details'>";
            echo "<h2>{$selectedHome['name']}</h2>";
            echo "<p class='label'>Location:</p>";
            echo "<p>{$selectedHome['location']}</p>";

            echo "<p class='label'>Description:</p>";
            echo "<p>{$selectedHome['description']}</p>";

            echo "<p class='label'>Ratings:</p>";
            echo "<p>{$selectedHome['rating']}</p>";


            echo "</div>";
            echo "</div>";

            echo "<p class='success'>Please Fill Up The Following Information!</p>";

            // Reservation form
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='home_id' value='{$selectedHome['home_id']}'>";
            echo "<input type='hidden' name='checkIn' value='$checkIn'>";
            echo "<input type='hidden' name='checkOut' value='$checkOut'>";
            echo "<label for='checkIn'>Check-in Date:</label>";
            echo "<input type='date' name='checkIn' required value='$checkIn'>";
            echo "<label for='checkOut'>Check-out Date:</label>";
            echo "<input type='date' name='checkOut' required value='$checkOut'>";
            if (isset($reservationError)) {
                echo "<p class='error' style='font-weight: bold'>$reservationError</p>";
            }

            echo "<button type='submit' class='btn'>Reserve Now</button>";
            echo "<button type='reset' class='btn'>Reset</button>";
            echo "</form>";
        } elseif ($reservationError) {
            echo "<p class='error'>$reservationError</p>";
        } else {
            echo "<p>No home selected.</p>";
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include("../inc/footer.php"); ?>
</body>

</html>