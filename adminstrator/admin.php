<?php
session_start();
if(!isset($_SESSION['log'])){
  header("Location:index.php");
  exit();
}
$pagename ='Admins';
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
  if(!isset($_GET['do'])){
    include 'design/admin-table.php';
  }
  
  elseif($_GET['do']=='edit'){
    include 'design/edit-admin.php';
  }
  ?>
</div>
   </div>
        </div>
 </main>
 <?php include 'include files/footer.php'; ?>