<h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">All Products</h2>
<?php
       $sess =$_SESSION['log'];
       if($sess != 3){
        ?>
    <div class="text-start ">
    <a href="?do=add">
    <button class="login   mt-2 btn">Add-New Product</button>
</a>
    </div>
    <?php
  }?>
<br>
<table class=" tab table mt-3"  style="width:100%;" id="example" >
        <thead>
            <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>offer</th>
        <th>count</th>
        <th>brand</th>
        <th>category</th>
        <th>description</th>
        <th>date</th>
        <th>cover</th>
        <?php
       
        if($sess != 3){?>
        <th>controls</th>
        <?php
        }
        ?>
       </tr>
        </thead>
        <tbody align="left">               
            <?php
 
   $sql = "SELECT prro.id,prro.name,prro.price,prro.count,prro.des,prro.cover,prro.date, prro.offer, cat.cat, brand.brand  FROM prro , cat, brand WHERE
   prro.cat=cat.id AND prro.brand=brand.id ORDER BY prro.id DESC" ;
      
   $result = $conn -> query($sql);
   $id=1;
    while($row =$result -> fetch_assoc()){
    if($row['date']=='1972-06-10 02:24:00'){
      $date = '0000-00-00 00:00:00';
    }
    else{
      $date = $row['date'];
    }
        echo "<tr><td>".$id++."</td>"; 
        echo "<td>".$row['name']."</td>";    
        echo "<td>".$row['price']."</td>"; 
        echo"<td>".$row['offer']."</td>"; 
        echo "<td>".$row['count']."</td>"; 
        echo "<td>".$row['brand']."</td>";
        echo "<td>".$row['cat']."</td>";
        echo"<td>".$row['des']."</td>"; 
        echo"<td>".$date."</td>"; 
        ?>
        <td>
        <?php
          $img=$row['cover'];
          $img_explode = explode(",", $img);
          $img_count = count($img_explode);
        for ($i=0; $i <$img_count; $i++) { 
          echo "<img src='assets/images/".$img_explode[$i]."' width='50'height='50' class='rounded-circle'>";
        } 
         ?>
         </td>

         <?php if($sess != 3){?>
   <td><a href="?do=edit&id=<?php echo $row['id'];?>" class="text-decoration-none text-light"> <button type="button" class="btn btn-success"><i class="fa-regular fa-keyboard"></i></button></a>
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
              <h5 class="modal-title " id="exampleModalLabel">Are Yoy Sure You Want To Delete?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-start">
                <?php echo $row['name'];?>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger"><a class="text-decoration-none text-light" href="sql/delete.php?id=<?php echo $row['id'];?>">DELETE</a></button>
            </div>
          </div>
        </div>
        
      </div>
         <?Php
         }
     } ?>
     </tbody>
   </table>