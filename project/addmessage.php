<?php
include "include files/connect.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    @$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    @$number =filter_var($_POST['number'],FILTER_SANITIZE_NUMBER_INT);
    @$email =mysqli_real_escape_string($conn,$_POST['email']);
    @$email1 =$_POST['email'];
    @$message = filter_var($_POST['message'],FILTER_SANITIZE_STRING );
    if(!empty($name) && !empty($number) && !empty($email) && mb_strlen($message,'utf8') > 0 && filter_var($email1, FILTER_VALIDATE_EMAIL)!==false){
    $sql_msg = "INSERT INTO message( name, email, number, message,view) VALUES ('$name','$email','$number','$message',0)";
    $res_msg = $conn -> query($sql_msg);  
      
    }
}
   




if(@$sql_msg==TRUE ){
    echo 1;
}
if((filter_var($email1, FILTER_VALIDATE_EMAIL))===false){
    echo '<input type = "hidden" value ="1">';
}
if(!$number){
echo '<input type = "hidden" value ="2">';
}
?>