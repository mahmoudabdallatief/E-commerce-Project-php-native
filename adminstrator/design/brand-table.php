<h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">All Brands</h2>
<?php
       $sess =$_SESSION['log'];
       if($sess != 3){
        ?>
    <div class="text-start ">
    <a href="?do=add">
    <button class="login   mt-2 btn">Add-New Brand</button>
</a>
    </div>
    <?php
  }?>
    <br>
<table class=" tab table  mt-3 "  style="width:100%" id="example">
        <thead>
            <tr>
        <th>id</th>
        <th>brand</th>
        <?php
        if($sess != 3){?>
        <th>controls</th>
        <?php
        }
        ?>
       </tr>
        </thead>
        <tbody align='left'>               
            <?php
  $id=1;
   $sql = "SELECT * FROM brand ORDER BY id ASC" ;
    
   $result = $conn -> query($sql);
    while($row =$result -> fetch_assoc()){
        echo "<tr><td>".$id++."</td>"; 
        echo "<td>".$row['brand']."</td>";    
         ?>
         <?php if($sess != 3){?>
   <td> <a href="?do=edit&id=<?php echo $row['id'];?>" class="text-decoration-none text-light"> <button type="button" class="btn btn-success"><i class="fa-regular fa-keyboard"></i></button></a>
    <button type="button" class="btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#examplemodel<?php echo $row['id'];?>">
    <i class="fa-solid fa-trash"></i>
      </button>
    <!-- Modal -->
    </td>
    </tr>
         <div class="modal fade" id='examplemodel<?php echo $row['id'];?>' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are Yoy Sure You Want To Delete?</h5>
            </div>
            <div class="modal-body">
                <p class="text-start">
                <?php echo $row['brand'];?>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger"><a class="text-decoration-none text-light" href="sql/delete-brand.php?id=<?php echo $row['id'];?>">DELETE</a></button>
            </div>
          </div>
        </div>
        
      </div>
         <?Php
         }
     } ?>
     </tbody>
   </table>