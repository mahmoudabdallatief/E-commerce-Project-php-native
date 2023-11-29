<?php
$id =$_GET['id'];
include 'connect.php';
   $sql = "DELETE FROM admin WHERE id='$id'" ;  
   $result = $conn -> query($sql);

	header("Location:../admin.php?delete");
    ?>