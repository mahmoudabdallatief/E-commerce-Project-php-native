<?php
session_start();
include "include files/connect.php";
@$session = $_SESSION['login'];

$sum1 = "SELECT SUM(total) FROM chart where id_user = '$session'";
$result_sum = $conn->query($sum1);

foreach ($result_sum as $row_sum) {
  $sum = $row_sum['SUM(total)'];
}
$post_data = $_POST;
$empty_post_data = [];

// Loop through all of the POST data
foreach ($post_data as $key => $value) {
  // If the value is empty, add it to the `empty_post_data` array
  if ($value === '') {
    $empty_post_data[$key] = $value;
  }
}

// If the `empty_post_data` array is empty, then all of the POST data is empty



if (!empty($_POST['billing_name']) && !empty($_POST['billing_address']) && !empty($_POST['billing_city']) && !empty($_POST['billing_state']) && !empty($_POST['billing_zip'])&& !empty($_POST['shipping_name']) && !empty($_POST['shipping_address']) && !empty($_POST['shipping_city'])&& !empty($_POST['shipping_state']) && !empty($_POST['shipping_zip'])&& filter_var($_POST['billing_zip'], FILTER_SANITIZE_NUMBER_INT)===true && filter_var($_POST['shipping_zip'], FILTER_SANITIZE_NUMBER_INT)===true) {
  $order_data = [
    'billing_name' => mysqli_real_escape_string($conn,$_POST['billing_name']),
    'billing_address' => mysqli_real_escape_string($conn,$_POST['billing_address']),
    'billing_city' => mysqli_real_escape_string($conn,$_POST['billing_city']),
    'billing_state' => mysqli_real_escape_string($conn,$_POST['billing_state']),
    'billing_zip' => mysqli_real_escape_string($conn,$_POST['billing_zip']),
    'shipping_name' => mysqli_real_escape_string($conn,$_POST['shipping_name']),
    'shipping_address' => mysqli_real_escape_string($conn,$_POST['shipping_address']),
    'shipping_city' => mysqli_real_escape_string($conn,$_POST['shipping_city']),
    'shipping_state' => mysqli_real_escape_string($conn,$_POST['shipping_state']),
    'shipping_zip' => mysqli_real_escape_string($conn,$_POST['shipping_zip']),
    'total' => $sum,
  ];

  $sql = "INSERT INTO orders (
    user_id,
    billing_name,
    billing_address,
    billing_city,
    billing_state,
    billing_zip,
    shipping_name,
    shipping_address,
    shipping_city,
    shipping_state,
    shipping_zip,
    total
  ) VALUES (
    '$session',
    '{$order_data['billing_name']}',
    '{$order_data['billing_address']}',
    '{$order_data['billing_city']}',
    '{$order_data['billing_state']}',
    '{$order_data['billing_zip']}',
    '{$order_data['shipping_name']}',
    '{$order_data['shipping_address']}',
    '{$order_data['shipping_city']}',
    '{$order_data['shipping_state']}',
    '{$order_data['shipping_zip']}',
    '{$order_data['total']}'
  )";
   if($conn->query($sql)) {
    $delete_cart = "DELETE FROM chart WHERE id_user = '{$_SESSION['login']}'";
    $conn->query($delete_cart);
  echo 1;
  } else {
    echo 2;
  }
} else {
  echo 2;
}
?>
