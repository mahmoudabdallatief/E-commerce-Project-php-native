<?php
session_start();
if(!isset($_SESSION['log'])){
  header("Location:index.php");
  exit();
}
$pagename ='Orders';
include 'include files/header.php';
include 'include files/nav.php';
include 'include files/sidebar.php';
include 'sql/connect.php';


 ?>
 <main style="margin-top: 58px">
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-12">
          <?php
          if($_SESSION['log']!=3){

         
          ?>
        <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">All Orders</h2>

    
    <br>
<table class=" tab  table mt-3"  style="width:100%" id= "example" >
        <thead class="head">
            <tr>
            <th>id</th>
        <th>billing_name</th>
        <th>billing_zip</th>
        <th>shipping_zip</th>
        <th>total</th>
        <th>created_at</th>
       </tr>
        </thead>  
        <tbody align='left'>             
            <?php
  $id=1;
   $sql = "SELECT * FROM orders" ;
      
   $result = $conn -> query($sql);
    while($row =$result -> fetch_assoc()){
    ?><tr>
        <td><?=$row['id']?></td>
        <td><?=$row['billing_name'];?></td>
      
    <td><?=$row['billing_zip']?></td>   
    <td><?=$row['shipping_zip']?></td> 
    <td><?=$row['total']?></td> 
    
    <td><?=$row['created_at']?></td>
     
        
   
    </tr>
         <?Php
         }
     ?>
     </tbody>
   </table>
   <?php
      }
      else{?>
      <h2 class="p-1 text-center" style ="color:chocolate;">You are not Allow to Access on This Table</h2>
      <?php

      }
          ?>

        </div>
    </div>
</div>

 <?php include 'include files/footer.php'; ?>