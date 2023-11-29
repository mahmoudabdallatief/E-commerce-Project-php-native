<?php
session_start();
include "include files/connect.php";
// Connect to the database

// Get the product ID and user ID from the POST data
@$product_id = $_POST['pro_id'];
$user_id = $_SESSION['login'];
@$rating = $_POST['index'];

$check ="SELECT * FROM ratings WHERE user_id ='$user_id' AND product_id ='$product_id'";
$res_check =$conn-> query($check);
$num =$res_check-> num_rows;
if($num==0){
$insert = "INSERT INTO ratings( user_id, product_id, rating) VALUES ('$user_id','$product_id','$rating')";
}
else{
$insert ="UPDATE ratings SET rating='$rating' WHERE user_id ='$user_id' AND product_id ='$product_id'";
}
$res_ins =$conn -> query($insert);
?>
