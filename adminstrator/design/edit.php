<?php
$id= $_GET['id'];
?>
 <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit Your Product</h2>
<form action="./sql/do-edit.php" method="post" enctype="multipart/form-data" class="">
<br>
<?php
$sql6 = "SELECT * FROM prro WHERE id = '$id'" ;
            $result6 = $conn -> query($sql6);
            
            while($row6 =$result6 -> fetch_assoc()){
              $cat= $row6['cat'];
              $brand= $row6['brand'];
              $des = $row6['des'];
              $date = $row6['date'];
            ?>
 <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the name</label>
<br>
<br>
    <input type="text" name="name" placeholder="name" value="<?php echo mysqli_real_escape_string($conn,$row6['name'])?>" class="form-control">
    <br>
    <br>
    <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the price</label>
<br>
<br>
    <input type="text" name="price" placeholder="price" value='<?php echo $row6['price']?>' class="form-control">
    <br>
    <br>
    <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the offer</label>
<br>
<br>
<input type="text"  name="offer" placeholder="offer" value='<?php echo $row6['offer']?>' class="form-control">
    <br>
    <br>
    <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the count</label>
<br>
<br>
    <input type="text" name="count" placeholder="count" value='<?php echo $row6['count']?>'class="form-control">
    <br>
    <br>
    <label for="" class="form-label" style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the image</label> <Span class="text-danger"> ( jpg or jpeg or png or gif  )</Span>
    <br>
    <br>
    <input type="file" name="upload[]" multiple style="cursor:pointer;"class="form-control">
    <br>
    <br>
    <?php
    }?> 
    
    <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the category</label>
<br>
<br>
    <select name="cat" id="" class="form-control">
    <?php
    
            $sql1 = "SELECT * FROM cat WHERE parent > 0" ;
               
            $result1 = $conn -> query($sql1);
            
            ?>
            <?php
            while($row1 =$result1-> fetch_assoc()){
            
            ?>
<option value='<?php echo $row1['id']?>'<?php
if($row1['id']==$cat){
    echo'selected';
}
?>><?php echo $row1['cat']?></option>
            <?php
        }
        ?>
        </select>
<br>
<br>
<label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the brand</label>
<br>
<br>
<select name="brand" id=""class="form-control">
            <?php
            $sql2 = "SELECT * FROM brand";
               
            $result2 = $conn -> query($sql2);
            while($row2 =$result2 -> fetch_assoc()){
                
            ?>
            <option value='<?php echo $row2['id']?>'
            <?php
if($row2['id']==$brand){
    echo'selected';
}
?>><?php echo $row2['brand']?></option>
        <?php
        }
        ?>
        </select>
    <br>
    <br>
   
             <label for="" class="text-start  pb-2"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Edit the describtion</label>
<br>
<br>
           <textarea style="width: 100%;height: 400px; " name="describtion"><?php echo $des;?></textarea>
        <br>
           <br>
           <input type="hidden" name='id' value='<?php echo $id;?>'>
           <input type="hidden" name='sub_date' value='<?php echo $date;?>'>

<label for="" class="form-label" style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;"> Edit the count down date of product </label> <Span class="text-success">(optional)</Span>
<br>
<br>
<input type="datetime-local"  class="form-control" name="date" value="">
<br>
<br>
<button type="submit" class="btn mb-2  login">Edit</button>
 </form>  
