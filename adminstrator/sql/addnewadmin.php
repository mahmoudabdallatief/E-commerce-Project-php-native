<?php
include 'connect.php';
session_start();
$sess =$_SESSION['log'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$admin = mysqli_real_escape_string($conn,$_POST['admin']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$md5= md5($password);
$priv = $_POST['priv'];
if(!empty($admin) && !empty($password) && !empty($priv)){
    $sql_ins ="INSERT INTO admin(username, password, pri) VALUES ('$admin','$md5','$priv')";
    $res_ins =$conn-> query($sql_ins);
}
else{
  echo 2;
}
}
?>