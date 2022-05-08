<?php
$conn = mysqli_connect("localhost", "root", "", "library_db");
if (!$conn) {
  die("No connect" . mysqli_connect_errno());
}
?>