<?php
session_start();
if(!isset($_SESSION['log'])){
  header("Location:index.php");
  exit();
}
$pagename ='Messages';
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
        <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">All Messages</h2>

    
    <br>
<table class=" tab  table mt-3"  style="width:100%" id= "example" >
        <thead class="head">
            <tr>
        <th>id</th>
        <th>name</th>
        <th>phone</th>
        <th>e-mail</th>
        <th>view</th>
        <th>date</th>
        <th>controls</th>
       </tr>
        </thead>  
        <tbody align='left' class="live">             
            <?php
  $id=1;
   $sql = "SELECT * FROM message ORDER BY date DESC" ;
      
   $result = $conn -> query($sql);
    while($row =$result -> fetch_assoc()){
        $read =$row['view'];?>
     <tr><td><?=$id++?></td> 
    <td><?=$row['name']?></td>   
    <td><?=$row['number']?></td> 
    <td><?=$row['email']?></td> 
    <td id ="m<?=$row['id']?>"><?php
    if($read==0){
        echo'unread';
    }
    else{
      echo 'read';
    }
    ?></td>
    
    <td id ="z<?=$row['id']?>"><?=$row['date']?></td>
     
        
        
   <td>
    <button type="button" class="btn btn-warning my-0" data-bs-toggle="modal" data-bs-target="#examplemodel<?php echo $row['id'];?>">
    <i class="fa-solid fa-comments-dollar text-light"></i>
      </button>
    <!-- Modal -->
    </td>
    </tr>
         <div class="modal fade" id='examplemodel<?php echo $row['id'];?>' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are Yoy Sure You Want To Read?</h5>
            </div>
            <div class="modal-body">
                <p class="text-start">
                <?php echo $row['message'];?>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-del btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="hidden" value ="<?=$row['id']?>" name ="delid" class ="delid">
              
            </div>
          </div>
        </div>
        
      </div>
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