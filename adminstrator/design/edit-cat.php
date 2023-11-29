<?php
$id= $_GET['id'];
?>
 <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit Your Category</h2>
<form action='./sql/do-edit-cat.php' method="post"  class="">
<br>
<?php
$sql6 = "SELECT * FROM cat WHERE id = '$id'" ;
            $result6 = $conn -> query($sql6);
            
            while($row6 =$result6 -> fetch_assoc()){

            ?>
  <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit The Name of Category</label> 
 <br>
<br>
    <input type="text" name="name" placeholder="category" value="<?php echo mysqli_real_escape_string($conn, $row6['cat'])?>" class="form-control">
    <br>
    <br>
    <label class="text-start "  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit The Parent of Category</label>
    <br>
    <br>
    <input type="text" name="parent" placeholder="parent" value="<?php echo $row6['parent']?>" class="form-control">
    <br>
    <br>
    <input type="hidden" name='id' value='<?php echo $row6['id'];?>'>
    <?php
    }?>
    <button type="submit" class="btn  login">Edit</button>
 </form>  
