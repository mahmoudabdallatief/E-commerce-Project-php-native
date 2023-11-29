<?php
session_start();
session_unset();
session_destroy();
setcookie("id", "", time() - 3600);
setcookie("price", "", time() - 3600);
setcookie("quantity", "", time() - 3600);
header("Location:products.php");
?>