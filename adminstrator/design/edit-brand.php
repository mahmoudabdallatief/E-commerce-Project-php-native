<?php
$id= $_GET['id'];
?>

 <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit Your Brand</h2>
<form action='./sql/do-edit-brand.php' method="post"  class="">
<br>
<?php
$sql6 = "SELECT * FROM brand WHERE id = '$id'" ;
            $result6 = $conn -> query($sql6);
            
            while($row6 =$result6 -> fetch_assoc()){

            ?>
 <!-- <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the Brand</label> -->
<!-- <br>
<br> -->
    <input type="text" name="name" placeholder="brand" value="<?php echo mysqli_real_escape_string($conn,$row6['brand'])?>" class="form-control">
    <br>
    <br>
    <input type="hidden" name='id' value='<?php echo $row6['id'];?>'>
    <?php
    }?>
    <button type="submit" class="btn  login">Edit</button>
       
       

 </form>  