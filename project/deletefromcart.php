<?php
session_start();
@$session =$_SESSION['login'];
include "include files/connect.php";
@$id =$_POST['delid'];
    $sql = "DELETE FROM chart WHERE id ='$id'" ;  
    $result = $conn -> query($sql);
                $count_chart ="SELECT COUNT(id) FROM chart WHERE id_user ='$session' "; 
          $res_count_chart= $conn-> query($count_chart);
          foreach ($res_count_chart as $row_chart ) {
            $count =  $row_chart['COUNT(id)'];
          }
          $sum ="SELECT SUM(total) FROM chart WHERE id_user=$session";
                    $result_sum = $conn->query($sum);
                    foreach ($result_sum as $row_sum) {
                       
                            $sum3= $row_sum['SUM(total)'];
                        
                       
                        
                    }
                    $arr =array("count"=> $count ,"sum"=>$sum3);
                    echo json_encode($arr);
                  
                    


?>