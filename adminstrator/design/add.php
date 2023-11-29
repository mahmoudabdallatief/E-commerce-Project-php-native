
 <h2 class="text-start   p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;">Add New Product</h2>
<form action="./sql/do_add.php" method="post" enctype="multipart/form-data" class="">
<br>

    <input type="text" name="name" placeholder="name" class="form-control">

    <br>
    <br>
    <input type="text"  name="price" placeholder="price" class="form-control">
    <br>
    <br>
    <input type="text"  name="offer" placeholder="offer" class="form-control">
    <br>
    <br>
    <input type="text"  name="count" placeholder="count" class="form-control">
    <br>
    <br>
    <label for="" class="form-label" style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;"> Enter the image of product </label> <Span class="text-danger">( jpg or jpeg or png or gif  )</Span>
    <br>
    <br>
    <input type="file" name="upload[]" multiple style="cursor:pointer" class="form-control">
    <br>
    <br>
    
  
    <select name="cat" id="" class="form-control">
    <option selected disabled>category</option>
    <?php
            $sql1 = "SELECT * FROM cat WHERE parent > 0" ;
               
            $result1 = $conn -> query($sql1);
            
            ?>
            <?php
            while($row1 =$result1-> fetch_assoc()){
            
            ?>
<option value='<?php echo $row1['id']?>'><?php echo $row1['cat']?></option>
            <?php
        }
        ?>
        </select>
<br>
<br>
<select name="brand" id=""class="form-control">
    <option selected disabled> brand</option>
            <?php
            $sql2 = "SELECT * FROM brand";
               
            $result2 = $conn -> query($sql2);
            while($row2 =$result2 -> fetch_assoc()){
                
            ?>
            <option value='<?php echo $row2['id']?>'><?php echo $row2['brand']?></option>
        <?php
        }
        ?>
        </select>
    <br>
    <br>
    <label for="" class="form-label" style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;"> Enter the describtion of product </label>
<br>
<br>
<textarea style="width: 100%;height: 400px;" name="describtion"></textarea>
<br>
<br>
<label for="" class="form-label" style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;"> Enter the count down date of product </label> <Span class="text-success">(optional)</Span>
<br>
<br>
<input type="datetime-local"  class="form-control" name="date">
<br>
<br>
<button type="submit" class="btn mb-2 login">Add</button>
 </form>  


