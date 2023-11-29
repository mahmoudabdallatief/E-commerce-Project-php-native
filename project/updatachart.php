<?php
session_start();
$session = $_SESSION['login'];
include "include files/connect.php";
if (isset($_POST['action'])) {
    $quantity =  $_POST['quantity'];
    $price =  $_POST['price'];
    $id =  $_POST['id'];
    $total = $price * $quantity;

    $ins_to_chart = "UPDATE chart SET quantity= '$quantity' ,total='$total' WHERE id = '$id'";
    $result_ins = $conn->query($ins_to_chart);
}

$sql_chart = "SELECT * FROM chart WHERE id = '$id' ";
$result = $conn->query($sql_chart);
$num = $result->num_rows;
if ($num == 1) {
    foreach ($result as $row) {
        $rtotal = $row['total'];
    }
}

$sum = "SELECT SUM(total) FROM chart where id_user = '$session'";
$result_sum = $conn->query($sum);
foreach ($result_sum as $row_sum) {
    $sum1 = $row_sum['SUM(total)'];
}

$arr = array(
    "total" => $rtotal,
    "sum" => $sum1
);

$json_string = json_encode($arr);
echo $json_string;
