<?php
include 'connect.php';
$id = $_POST['delid'];
$ins_msg ="UPDATE message SET view = 1 WHERE id ='$id'";
$result_ins = $conn-> query($ins_msg);
if(@$ins_msg==TRUE){
    $view ="read";
  }
$sql_msg = "SELECT COUNT(view) FROM message WHERE view = 0  " ;
$result_msg = $conn -> query($sql_msg);
 while($row_msg =$result_msg -> fetch_assoc()){
$count = $row_msg['COUNT(view)'];

}
$sql_date = "SELECT date FROM message WHERE id = $id  " ;
$result_date = $conn -> query($sql_date);
 while($row_date = $result_date -> fetch_assoc()){
$date = $row_date['date'];

}
$arr =array("view"=> $view ,"count"=> $count, "date"=>$date);
echo json_encode($arr);