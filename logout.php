<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "pms");
if ($conn->connect_errno > 0) {
    echo("Unable to connect: " . $conn->connect_error);

}
session_destroy(); //destroy the session
header("location: http://localhost/Patient%20Managment%20System/index.php"); //to redirect back to "index.php" after logging out
exit();
?>