<?php
$server_db = "localhost:3308";
$user_db ="root";
$password_db="";
$db_name ="product";
$conn = new mysqli($server_db,$user_db,$password_db,$db_name);
$conn -> set_charset("utf8");
?>