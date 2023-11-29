<?php
$pagename ='Dashboard';
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
session_start();
if (!isset($_SESSION['log'])) {
    header("Location:index.php");
    exit();
}
include 'sql/connect.php';
$sess= $_SESSION['log'];
$sql = "SELECT * FROM admin,priv WHERE admin.pri = priv.id_priv AND  admin.pri= '$sess'  " ;
      
   $result = $conn -> query($sql);
    while($row =$result -> fetch_assoc()){
 $username = $row['username'];
    }

include 'include files/header.php';
include 'include files/nav.php';
include 'include files/sidebar.php';
include 'sql/connect.php';
?>
 <main style="margin-top: 58px">
 <br>
 <br>
<div class="container text-center  pt-1">
    <div class="row ">
    <div class="col-12 " >
    <h2 class="text-start p-1 "  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Dashboard</h2>
<h3 class="text-start h ">HELLO <span class="sess" style="  color:chocolate;  text-transform:capitalize"> <?php 
 
echo $username; 

?>
</span>
</h3>
<br>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3  ">
        <div class="card dash h-100">
            <br>
            <i class="fa-solid fa-cart-shopping   fa-2x"></i>
        <br>
        
							<p> <?php
  
  $sql_msg = "SELECT  COUNT(*) AS order_count FROM orders  " ;
      
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
echo $row_msg['order_count'];
   }
  ?></p>
							<p>Orders</p>
        </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card dash  h-100">
        <br>
        <i class="fa-solid fa-comment fa-2x"></i>
        <br>
							<p><?php
  
  $sql_msg = "SELECT COUNT(id) FROM comment  " ;
      
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
echo $row_msg['COUNT(id)'];
   }
  ?></p>
							<p>Comments</p>
        </div>
        
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card dash  h-100">
        <br>
        <i class="fa-solid fa-user fa-2x"></i>
        <br>
							<p><?php
  
  $sql_msg = "SELECT COUNT(id_user) FROM users  " ;
      
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
echo $row_msg['COUNT(id_user)'];
   }
  ?></p>
							<p>Users</p>
        </div>
       
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card dash  h-100">
        <br>
        
        <i class="fa-brands fa-product-hunt fa-2x"></i>
        <br>
							<p><?php
  
  $sql_msg = "SELECT COUNT(id) FROM prro  " ;
      
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
echo $row_msg['COUNT(id)'];
   }
  ?></p>
							<p>Products</p>
        </div>
  
        </div>
    </div>
</div>
</main>

 <?php include 'include files/footer.php'; ?>

