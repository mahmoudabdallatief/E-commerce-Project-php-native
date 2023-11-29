<?php
include "include files/connect.php";
 $update = $_POST['update'];
 $message =mysqli_real_escape_string($conn,$_POST['message']);
if(mb_strlen($message,'utf8')>0){
    $sql_update = "UPDATE comment SET comment = '$message' WHERE id ='$update'";
    $upd_res = $conn -> query($sql_update);
    $sql_res ="SELECT * FROM comment WHERE id ='$update'";
    $res =$conn->query($sql_res);
    foreach($res as $row){
       $date =$row['date'];
       $comment =$row['comment'];
       $arr =array("date"=>$date,"comment"=>$comment);
       echo json_encode($arr);
    }
   
}
if(mb_strlen($message,'utf8')==0){
    echo 2;
}

?>