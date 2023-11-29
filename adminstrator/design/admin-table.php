<?php
$sess =$_SESSION['log'];
if($sess !=3){
?>
<h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Admins</h2>

<button class="login   mt-2 btn " data-bs-toggle="modal" data-bs-target="#exampleModal">Add-New Admin</button>
<br>
<br>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add-new-Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="input-group">
        <input type="text" class="admin mb-2 form-control" name="admin" placeholder="username">
</div>
        <div class="input-group">
        <input type="password" class="password pass mb-2 form-control" name="password" placeholder="password">
        <span class="input-group-text h-auto eye-icon " style="height:38px !important "><i class="fa-sharp fa-solid fa-eye"></i></span>
        
      </div>
        <select name="priv" id="priv" class="mb-2 form-control">
          <option class="opt-dis" selected disabled>Choose The Type of Admin</option>
          <?php
          $select_priv="SELECT * FROM priv WHERE id_priv >='$sess' AND id_priv != 1";
          $res_pri =$conn->query($select_priv);
          foreach($res_pri as $row){
            ?>
            <option  value="<?=$row['id_priv']?>"><?=$row['name']?></option>
            <?php
          }
          ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn addadmin login" data-bs-dismiss="modal">Add</button>
      </div>
    </div>
  </div>
</div>
<table class=" tab table  mt-5 "   style="width:100%" id="example">
        <thead class="hh">
            <tr>
        <th>id</th>
        <th>username</th>
        <th>class</th>
        <th>priv</th>
        <th>controls</th>
       </tr>
        </thead>
        <tbody class="tt"   align='left'>               
            <?php


   $sql = "SELECT * FROM admin,priv WHERE admin.pri = priv.id_priv AND NOT admin.pri=1 AND NOT admin.pri= '$sess'  ORDER BY id ASC" ;
      
   $result = $conn -> query($sql);
    while($row =$result -> fetch_assoc()){?>
        <tr><td><?=$row['id']?></td>
        <td><?=$row['username']?></td>  
        <td><?=$row['name']?></td> 
        <td><?=$row['priv']?></td>
       
   <td> <a href="?do=edit&id=<?php echo $row['id'];?>" class="text-decoration-none text-light"> <button type="button" class="btn btn-success"><i class="fa-regular fa-keyboard"></i></button></a>
    <button type="button" class="btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#examplemodel<?php echo $row['id'];?>">
    <i class="fa-solid fa-trash"></i>
      </button>
      <div class="modal fade" id='examplemodel<?php echo $row['id'];?>' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Are Yoy Sure You Want To Delete?</h5>
            </div>
            <div class="modal-body">
                <p class="text-start text-dark">
                <?php echo $row['username'];?>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger"><a class="text-decoration-none text-light" href="sql/delete-admin.php?id=<?php echo $row['id'];?>">DELETE</a></button>
            </div>
          </div>
        </div>
        
      </div>
         <?Php
     } ?>
    <!-- Modal -->
    </td>
    </tr>
        
     </tbody>
   </table>
<?php
  }
  if($sess == 3){
    ?>
    <h2 class="p-1 text-center" style ="color:chocolate;">You are not Allow to Access on This Table</h2>
    <?php
  }
  ?>
  
