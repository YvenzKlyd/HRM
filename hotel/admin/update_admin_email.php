<?php
# database
include("../inc/db.php");

// Update admin email
$sql = "UPDATE admin SET admin_email = 'admin@gmail.com' WHERE admin_id = 2";
$result = $con->query($sql);

if ($result) {
    echo "Admin email updated successfully to admin@gmail.com";
} else {
    echo "Error updating admin email: " . $con->error;
}
?> 