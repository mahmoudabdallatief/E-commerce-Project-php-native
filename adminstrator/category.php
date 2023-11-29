<?php
session_start();
if(!isset($_SESSION['log'])){
  header("Location:index.php");
  exit();
}
$pagename ='Category';
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
  include 'design/cat-table.php';
}
elseif($_GET['do']=='add'){
  include 'design/add-cat.php';
}
elseif($_GET['do']=='edit'){
  include 'design/edit-cat.php';
}

?>
</div>
   </div>
        
        </div>
 </main>
 <?php include 'include files/footer.php'; ?>
 