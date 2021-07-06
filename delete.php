<?php require "connection.php"; ?>
<?php require "controllerUserData.php"; ?>
<?php
include 'users.php';
 ?>
<?php
$query="DELETE FROM usertab where id='$id';
$query_run= mysqli_query($con,$query);

 ?>
