<?php
  include 'connect.php';
  $sql_msg = "SELECT COUNT(view) FROM message WHERE view = 0  " ;
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
    ?>
    <div id="u">
<?=$row_msg['COUNT(view)'];?>
    </div>
 <?php 
   }
  ?>