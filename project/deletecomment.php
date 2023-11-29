<?php
include "include files/connect.php";
 $delete = $_POST['delete'];
 $pro = $_POST['pro'];
    $sql_delete = "DELETE FROM comment WHERE id ='$delete'";
    $del_res = $conn -> query($sql_delete);
    $result = $conn->query("SELECT COUNT(*) FROM comment WHERE id_pro = '$pro'");
$row = $result->fetch_row();
$num = $row[0];
echo json_encode(array("num"=>$num));

   


?>