<?php
session_start();
include "include files/connect.php";
 $id_user = $_SESSION['login'];
 $id_pro= $_POST ['pro'];
 $message =mysqli_real_escape_string($conn,$_POST ['message']);
 if(mb_strlen($message,'utf8')>0){
 $sql_check ="SELECT * FROM users WHERE id_user = '$id_user'";
 $res =$conn->query($sql_check);
 foreach($res as $row){
    $name = $row['username'];
 }
  $insert = "INSERT INTO comment(id_user, id_pro, name, comment) VALUES ('$id_user','$id_pro','$name','$message')";
  $res_ins =$conn ->query($insert);
}
else{
  echo 1;
}
?>