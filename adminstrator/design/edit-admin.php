<?php
$sess =$_SESSION['log'];
$id= $_GET['id'];
$sql_head = "SELECT * FROM admin,priv WHERE id = '$id' AND admin.pri= priv.id_priv " ;
$result_head =$conn->query($sql_head);
foreach($result_head as $row_head ){
    $pri =$row_head['pri'];
    ?>

 <h2 class="text-start p-1"  style="  color:chocolate; border-bottom:1px solid aqua; width:fit-content;"> Edit the privileges of  <?=$row_head['name']?></h2>
 <?php
}
?>
<form action='./sql/do-edit-admin.php' method="post"  class="">
<br>
    <select name="pri" id="" class="form-control">
        <?php
        $sql_priv = "SELECT * FROM priv WHERE id_priv >='$sess' AND id_priv != 1";
        $result_priv= $conn-> query($sql_priv);
        foreach($result_priv as $row_priv){
            
            ?>
            <option value="<?=$row_priv['id_priv']?>" <?php if($row_priv['id_priv']==$pri){echo'selected';}?>><?= $row_priv['name']?></option>
            <?php
        }
        ?>

    </select>
    <br>
    <br>
    <input type="hidden" name='id' value='<?=$id;?>'>
    <button type="submit" class="btn  login">Edit</button>
       
       

 </form>  