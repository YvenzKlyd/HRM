<?php
# database
include("../inc/db.php");

// Update admin name
$sql = "UPDATE admin SET admin_name = 'admin' WHERE admin_id = 2";
$result = $con->query($sql);

if ($result) {
    echo "Admin name updated successfully to 'admin'";
} else {
    echo "Error updating admin name: " . $con->error;
}
?> 