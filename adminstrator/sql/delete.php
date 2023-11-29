<?php
$id =$_GET['id'];
include 'connect.php';
   $sql = "DELETE FROM prro WHERE id ='$id'" ;  
   $result = $conn -> query($sql);

	header("Location:../products.php?delete");
    ?>