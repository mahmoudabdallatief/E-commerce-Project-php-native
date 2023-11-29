<?php
include "include files/connect.php";
@$user_id =$_GET['user_id'];
    $sql = "DELETE FROM chart WHERE id_user ='$user_id'" ;  
    $result = $conn -> query($sql); 

header("Location:chart.php");
?>