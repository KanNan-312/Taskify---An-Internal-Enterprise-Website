<?php 
  $conn= new mysqli('localhost','root','kth302110','enterprise_db');
  if (!$conn)
  die("Could not connect to mysql".mysqli_error($con));
?>