<?php
include 'connect.php';
error_reporting(E_ALL & ~E_NOTICE);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$id = $_POST['id'];
$pri= $_POST['pri'];
$sql1= "UPDATE admin SET pri ='$pri' WHERE id = '$id'";
                   $conn -> query($sql1);
                 header("Location:../admin.php?update");
}


?>