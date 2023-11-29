<?php
$id =$_GET['id'];
include 'connect.php';
   $sql = "DELETE FROM comment WHERE id='$id'" ;  
   $result = $conn -> query($sql);

	header("Location:../comment.php?delete");
    ?>