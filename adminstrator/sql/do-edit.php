<?php
include 'connect.php';
error_reporting(E_ALL & ~E_NOTICE);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $sub_date=mysqli_real_escape_string($conn, $_POST['sub_date']);
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $price =$_POST['price'];
    $count =$_POST['count'];
    $cat = $_POST['cat'];
    $brand = $_POST['brand'];
    $des =mysqli_real_escape_string($conn, $_POST['describtion']);
    $date =mysqli_real_escape_string($conn, $_POST['date']);
    $offer =$_POST['offer'];
    $error= array();
    if(!empty($name)){
      $sql= "UPDATE prro SET name ='$name' WHERE id = '$id'";
      $conn -> query($sql);
    }
  
  if (isset($price)) {
      if ((!empty($price) ||$price === "0") && preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $price)) {
          $price = str_replace(',', '.', $price); // Replace comma with period
          $sql1 = "UPDATE prro SET price = '$price' WHERE id = '$id'";
          $conn->query($sql1);
      }
  }

  if (isset($count)) {
    if ((!empty($count) ||$count === "0") && preg_match('/^\d+$/', $count)) {
        $count = str_replace(',', '.', $count); // Replace comma with period
        $sql2= "UPDATE prro SET count ='$count' WHERE id = '$id'";
        $conn -> query($sql2);
    } 
}
  
if(!empty($cat)){
  $sql3= "UPDATE prro SET cat ='$cat' WHERE id = '$id'";
  $conn -> query($sql3);
}
if(!empty($brand)){
  $sql4= "UPDATE prro SET brand ='$brand' WHERE id = '$id'";
      $conn -> query($sql4);
}
    
    if(mb_strlen($des,'utf8')>0){
      $sql5= "UPDATE prro SET des ='$des' WHERE id = '$id'";
      $conn -> query($sql5);
    }
    if(empty($date)){
              $sql8= "UPDATE prro SET date ='$sub_date' WHERE id = '$id'";
              $conn -> query($sql8);
             }
             if(!empty($date)){
              $sql8= "UPDATE prro SET date ='$date' WHERE id = '$id'";
              $conn -> query($sql8);
             }
             if (isset($offer)) {
              if ((!empty($offer) ||$offer === "0") && preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $offer)) {
                  $offer = str_replace(',', '.', $offer); // Replace comma with period
                  $sql9 = "UPDATE prro SET offer = '$offer' WHERE id = '$id'";
                  $conn->query($sql9);
              } 
          }
          
    $file_name =$_FILES['upload']['name'];
    $array_img =array();
    $count_file = count($file_name);
    $ext = array("jpg","jpeg","png","gif");
    for ($i=0; $i < $count_file ; $i++) { 
      $explode[$i] =explode(".",$file_name[$i]);                        
      $end[$i]= end($explode[$i]);
      
              if(!in_array($end[$i],$ext) &&  $_FILES['upload']['name'][0]!=""   ){
               array_push($error , "The type of image is not valid");
              }
              if($_FILES['upload']['size'][$i] > 20000000000000000000000 && $_FILES['upload']['name'][0]!=""  )  {
                array_push($error , "The Size of image is so big");
               } 
      if(($_FILES['upload']['size'][$i] < 20000000000000000000000)&&
      ($_FILES['upload']['type'][$i] =='image/jpg' or $_FILES['upload']['type'][$i] =='image/jpeg'
      or $_FILES['upload']['type'][$i] =='image/gif' or $_FILES['upload']['type'][$i] =='image/png' )
      && !empty($name) && !empty($price) && !empty($count) &&!empty($offer)&& !empty($cat) && !empty($brand)&& mb_strlen($des,'utf8') >0 ){
          $new_img_name = md5(uniqid()).$file_name[$i];
$folder = "../assets/images/$new_img_name";
              
                move_uploaded_file($_FILES['upload']['tmp_name'][$i],$folder);

                array_push($array_img , $new_img_name);
                $img_count =count($array_img);
                
                  $implode =implode(",",$array_img);
             
              }
             if($img_count==$count_file){
              $sql7= "UPDATE prro SET cover='$implode'  WHERE id = '$id'";
              $conn -> query($sql7);
             } 
                
       
                if(empty($name)){
                  array_push($error , "Empty input of name");
                }
                if(empty($price) && $price != '0'){
                  array_push($error , "Empty input of price");
                }
                if(empty($count) && $count != '0'){
                  array_push($error , "Empty input of count");
                }
                if(empty($offer) && $offer != '0'){
                  array_push($error , "Empty input of offer");
                }
                if(empty($cat)){
                  array_push($error , "Empty input of category");
                }
                 if(empty($brand)){
                  array_push($error , "Empty input of brand");
                }
                if(mb_strlen($des,'utf8') == 0){
                  array_push($error , "Empty text of describtion");
                }
                if (!empty($count) && !preg_match('/^\d+$/', $count)) {
                  array_push($error, "The Count must be integer");
                }
                if (!empty($price) && !preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $price)) {
                  array_push($error, "The Price must be integer or decimal number");
              }
              if (!empty($offer) && !preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $offer)) {
                  array_push($error, "The Offer must be integer or decimal number");
              }
              
                              
                $err_count =count($error);
                if((!$sql||!$sql1||!$sql2||!$sql3||!$sql4 ||!$sql5|| !$sql8 || !$sql9|| $_FILES['upload']['size'][$i] > 20000000000000000000000 ||$_FILES['upload']['type'][$i] !='image/jpg' || $_FILES['upload']['type'][$i] !='image/jpeg'  || $_FILES['upload']['type'][$i] !='image/gif' || $_FILES['upload']['type'][$i] !='image/png' && $_FILES['upload']['name'][0]!=""  )){
                  if($i==0){
        ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="icon" type="image/x-icon" href="../assets/images/34583214-logo-admin-icon-administrator-illustration-of-a-man-in-a-jacket-and-shirt-ties-jacket-and-shirt-.webp">
                <link rel="stylesheet" href="../assets/css/bootstrap.css">
                <link rel="stylesheet" href="../assets/css/style.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
                <title>ERROR</title>
            </head>
            <body>
            <br>
            <br>
              <div class="container  ">
           <div class="row  justify-content-center">
               <div class="col-lg-4 col-md-12 col-sm-12 border border-1 shadow rounded-3 ">
                   <div class=" mt-3 pb-2 border-bottom  text-danger">
                    ERROR
                   </div>
           <br>	
           <div class=" mb-3 pb-2   text-danger">This Error because the following :- </div>
            	
                <?php
                $c =1;
                for ($z=0; $z <$err_count ; $z++) { 
                  ?>
                  <p class="   mb-3 pb-2   text-danger"><?php echo $c++ ." - ". $error[$z]?> .</p>
                  <?php
                }
                ?>
                   </div>
           </div>
               </div>
           </body>
           </html>
        <?php
                }
              }
                if($sql&&$sql1&&$sql2&&$sql3&&$sql4 &&$sql5 &&$sql8 &&$sql9 && ($sql7==TRUE || $_FILES['upload']['name'][0]=="")){
                  header("Location:../products.php?update");
                  
                } 
              }              
          }     
        ?>
       
      
          
        
            
        

          
      
         
  
