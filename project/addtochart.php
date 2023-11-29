<?php
session_start();
include "include files/connect.php";
$session = $_SESSION['login'];
if(isset($_COOKIE["id"]) && !isset($_GET['id'])){
@$proid = $_COOKIE["id"];
@$price = $_COOKIE["price"];
@$quantity = $_COOKIE["quantity"];
}
else{
  @$proid= $_GET['id'];
  @$price= $_GET['price'];
  @$quantity=$_GET['quantity'];
}

  $total =$price*$quantity;






$sql_check ="SELECT * FROM chart WHERE id_user = '$session' AND id_pro ='$proid' ";
    $result_Check = $conn-> query($sql_check);
    $num = $result_Check->num_rows;
    if($num==0){
       
            $ins_to_chart = "INSERT INTO chart( id_user,id_pro,quantity,total ) VALUES ('$session','$proid','$quantity','$total')";
            $result_ins= $conn-> query($ins_to_chart);
        

    }

    if($num>0){
     
        $ins_to_chart ="UPDATE chart SET quantity= '$quantity',total='$total' WHERE id_user ='$session' AND id_pro ='$proid'";
        $result_ins= $conn-> query($ins_to_chart);
   

}


 header("Location:chart.php");

?>