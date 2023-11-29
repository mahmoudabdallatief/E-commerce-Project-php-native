<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$session =$_SESSION['login'];
if($_SERVER['REQUEST_METHOD']=='POST'&& !isset($_SESSION['login'])){
$pro_id = $_POST['pro_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
setcookie("id", $pro_id, time() + 3600);
setcookie("price", $price, time() + 3600);
setcookie("quantity", $quantity, time() + 3600);
 header("Location:login.php");
    
 }
 $id= $_GET['id'];
 if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_SESSION['login'])){
  $pro_id = $_POST['pro_id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  header("Location:addtochart.php?id=".$pro_id." &quantity=".$quantity."&price=".$price."");
    
  }
$pagename = "Single-Product";
include "include files/connect.php";
include "include files/header.php";
include "include files/nav.php";

?>
<br>
<br>
<div class="container mb-5">
<div class="row">
<div class="col-12 mb-5 single-head h5">
     </div>
<?php
$time = date('m/d/Y H:i:s', time());
$time_num= strtotime($time)+3600;
if(isset($id)){
  $sql = "SELECT prro.id,prro.name,prro.price,prro.count,prro.des,prro.cover,prro.date, prro.offer, cat.cat, brand.brand FROM prro , cat, brand WHERE
  prro.cat=cat.id AND prro.brand=brand.id AND prro.id='$id'" ;
}

@$result = $conn -> query($sql);
if($result->num_rows>0){


 foreach($result as $row){
  $id_pro =$row['id'];
  $single_img= $row['cover'];
        $single_explode = explode(",",$single_img);
        $img_single = count($single_explode);
   $cat = $row['cat'];
        $date= $row['date'];
        $date_num= strtotime($date);
  ?>
 <div class="col-12 mb-4">
    <div class=" p-2  product  card text-start">
    <div class="row g-0">

   
    <div class="col-md-4  ">
   
    <?php
      for ($n=0; $n <$img_single ; $n++) { 
        if($n==0){
      ?>
      <img  loading="lazy" src="../adminstrator/assets/images/<?php echo $single_explode[$n]?>" class="w-100 big_img" alt="..." title="<?php echo $row['name'];?>" >
      <?php
      }
    }
      ?>
      <div class="d-flex justify-content-around mt-3 ">
      <?php
      for ($z=0; $z <$img_single ; $z++) { 
      ?>
      <div class="d-block m-1">
     
      <img loading="lazy" src="../adminstrator/assets/images/<?php echo $single_explode[$z]?>" class= "w-100 small_img 
      <?php if ($z==0) {
        echo 'gallery';
      }?>" height =100  alt="..." title="<?php echo $row['name'];?>" style="cursor:pointer;   border-radius: 5px;">
      </div>
      <?php
      }
    
      ?>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h4><b class="text-light">Product :</b> <?php echo $row['name']?>.</h4>
      <br>
      <p><b class="text-light">Price :</b> <span class="<?php if($date_num > $time_num){echo'text-decoration-line-through';}
  ?>"><?php echo $row['price']?> $.</span></p>
      <p ><b class="text-light">Count :</b> <?php echo $row['count']?>.</p>
      <p><b class="text-light">Category :</b> <?php echo $row['cat']?>.</p>
      <p><b class="text-light">Brand :</b> <?php echo $row['brand']?>.</p>
<p><b class="text-light" >Description :</b> 
<br>
<?php echo $row['des']?></p>
<?php
if($date_num > $time_num){
?>
<input type="hidden" class="date" value="<?php echo $date;?>">
<?php
}
?>

<?php if($date_num > $time_num){
  ?>
  <div id="finish">
  <p  style="width:fit-content;"><b class="text-light" >Offer : </b ><?=$row['offer'];?> $.</p>
  <p><b class="text-light">This offer will finish after :</b></p>
  <div class="d-flex   justify-content-center">
          <div  class="d-block m-2" >days</div>
          <div  class="d-block  m-2" > hours</div>
          <div  class="d-block  m-2" > minutes</div>
          <div class="d-block  m-2"> seconds</div>
        </div>
        <br>
          <div class="d-flex time-div justify-content-center">
            <div id="days" class="d-block m-2 p-2" ></div>
            <div id="hours" class="d-block m-2  p-2"></div>
            <div id="minutes" class="d-block m-2 p-2"></div>
            <div id="seconds" class="d-block m-2  p-2"></div>
          </div>
          </div>
        
   <?php     
}?>
<form class="quantity justify-content-center mt-5 " action="single.php" method="post">
 
 <button class="dec-btn  p-0 "name ="action" type ="button"><i class="fas fa-caret-left"></i></button>
 <input class="form-control form-control-sm border-0 shadow-0 p-0 num" type="number" value="1" name="quantity"
                           min="1" max="<?=$row['count']?>"
                           >
                           <input type="hidden" class=" max" value="<?=$row['count']?>">
                           <button class="inc-btn  p-0"name ="action" type ="button"><i class="fas fa-caret-right"></i></button>

   <input type="hidden" name="pro_id" value="<?=$row['id']?>"class="product_id">
   <input type="hidden" name="price" value="<?php
   if($date_num > $time_num){
     echo $row['offer'];
   }
   else{
     echo $row['price'];
   }
   ?>">
 

 <div class="d-block ms-4">
 <button class="addtochart btn w-100" type="submit" name="addtochart">Add to Cart</button>
 </div>
   
 

 </form>
  <div class="rate my-3">
    <div class="rate-display">

    
    <?php
    $rate = "SELECT AVG(rating), COUNT(product_id) FROM ratings WHERE product_id='$id'";
    $res_rate =$conn -> query($rate);
    foreach($res_rate as $row_rate){
    if($row_rate['COUNT(product_id)']==0){
      
      ?>
      
<span style="color:gold !important;"><span style="color: #fff !important;"><b>Product Rating :</b></span> 0 </span>
      <?php
    }
    else{
      $round =round($row_rate['AVG(rating)']);
      ?>
      <span class="me-2" style="color:#fff !important;"><span class="me-2" style="color:#fff !important;"><b>Rating For This Product :</b></span> <?php
       for ($s=1; $s <=5 ; $s++) { ?>
        <i class="fa fa-star fa-1x " style="<?php if($s<=$round){echo'color: gold !important;';}?>" data-index="<?=$s?>"  ></i>
        
        <?php
      }?> Based on <?=$row_rate['COUNT(product_id)']?> Rating</span>
      <?php
    }
  }
    ?>
  </div>
  </div>
  <br>
  <?php
  if(isset($session)){
    ?>
    <span class="" style="color:#fff !important;"><b>Rate The Product : (Your Rating) </b></span>
    <?php
    $rate_user ="SELECT * FROM ratings WHERE user_id ='$session' AND product_id ='$id'";
$res_user =$conn-> query($rate_user);
foreach($res_user as $row_user){
  $rate =$row_user['rating'];

}
    ?>
    
    <br>
    <div align="left" style="color:#fff;">
    <?php
    
    for ($e=1; $e <=5 ; $e++) { ?>
      <i class="fa fa-star fa-1x star" style="<?php if($e<=$rate){echo"color: gold !important;";}?>" data-index="<?=$e?>"  ></i>
      
      <?php
    }
    }
    else{?>
        <p class="text-center mb-5 h5"  style="color:gold; ">You Are Not Allow To Rate This Product Because You Are Not Logged in</p>
    <?php
    }
    ?>
  
        <br>
        
    </div>



 </div>
        </div>
 </div>
</div>
</div>
     <?php 
     }
    }
    ?>
      
</div>
</div>

      <div class="container ">
      <?php
        if(isset($_SESSION['login'])&& isset($id_pro)){
          ?>
      <div class="row co">
        
          
          <div class="text-center mb-5"><button class="btn login"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Comment</button></div>
          
          <?php
        }
        if(!isset($_SESSION['login'])){
          ?>
          <p class="text-center mb-5 h5"  style="color:crimson; ">You Are Not Allow To Write Comment Because You Are Not Logged in</p>
          <?php
        }
          ?>
      </div>
      </div>
      <div class="modal fade mod-update" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:crimson; ">Add a Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <textarea name="message"  class="w-100 my-3 message shadow" style="height:350px; border:1px solid crimson; border-radius:5px; color:crimson; "></textarea>
      <input type="hidden" class="pro" name ="pro" value="<?=$id?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn login comm" data-bs-dismiss="modal">Add</button>
      </div>
    </div>
  </div>
</div>
      <div class="container comment-con mb-5">
        <div class="row comment <?php if(!isset($id_pro)){echo'd-none';}?>">
        
        <div class="col-12 my-5 comment-head h5">
     </div>
      <?php
        $comment ="SELECT * FROM comment WHERE id_pro = '$id' ORDER BY id DESC";
        $res_com = $conn -> query($comment);
        $num_com = $res_com-> num_rows;
        if($num_com==0 && isset($id_pro)){
          ?>
<p class="text-center mb-5 h5 num-row" style="color:crimson; ">There is No Comment For This Product</p>
          <?php
        }
        else{
          foreach($res_com as $row_com){
            $mysqlTimestamp = strtotime($row_com['date']);
$dateWithDayName = date("l, F j, Y \\A\\t h:i:s A", $mysqlTimestamp);
        ?>
 <div class="col-12 comment-row" id="c<?=$row_com['id']?>">
  <div class=" comment-header ">
    <h3 style="text-transform:capitalize"><?=$row_com['name']?> <span class="ms-1  days" id="s<?=$row_com['id']?>">
<?="( ".$dateWithDayName." )" ?>
  </span></h3>
    
    </div>
    <div class="comment-body">
    <p id="p<?=$row_com['id']?>"><?=$row_com['comment']?></p>
    </div>
    <?php if($row_com['id_user'] == $session){
    ?>
  <div class="comment-footer">
    <button class ="btn " data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row_com['id']?>"><i class="fa-solid fa-user-pen"></i></button>
    <div class="modal fade" id="exampleModal<?=$row_com['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="exampleModalLabel " style="color:crimson; ">Edit a Comment</h5>
        <button type="button" class="btn-close bg-transparent" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <textarea name="message" id="m<?=$row_com['id']?>"  class="w-100 my-3  shadow" style="height:350px; border:1px solid crimson; border-radius:5px;font-size: 16px; color:crimson;"><?=$row_com['comment']?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-secondary text-light" data-bs-dismiss="modal">Close</button>
        <input type="hidden" name ="update" class="inp-update" value="<?=$row_com['id']?>">
        <button type="button" class="btn del_all update" data-bs-dismiss="modal" >Edit</button>
      </div>
    </div>
  </div>
</div>
    <button class ="btn" data-bs-toggle="modal" data-bs-target="#exampleModalt<?=$row_com['id']?>"><i class="fa-solid fa-trash-can" ></i></button>
    <div class="modal fade" id="exampleModalt<?=$row_com['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="exampleModalLabel " style="color:crimson; ">Are Yoy Sure You Want To Delete?</h5>
        <button type="button" class="btn-close bg-transparent" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color:crimson; font-size: 16px;" id="i<?=$row_com['id']?>">

        <?=$row_com['comment']?>
        </p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-secondary text-light" data-bs-dismiss="modal">Close</button>
         <input type="hidden" class="pro" name ="pro" value="<?=$id?>">
        <button type="button" class="btn del_all delete" data-bs-dismiss="modal" name="delete"data-delete="<?=$row_com['id']?>">DELETE</button>
      </div>
    </div>
  </div>
</div>
  </div>
  <?php
  }
  ?>
 </div>
        <?php
        }
      }
      
        ?>
        </div>
      </div>
<div class="container mt-3">
  <div class="row">
   <div class="col-12 mb-5 rel-head h5">
   <!-- <h4 class=" related ">The Products Associated with : <span>.</span></h4> -->
   </div>

    <?php
    $limit=04;
    if(isset($_GET["page"]))
    {
      $page=$_GET["page"];
    }
    else
    {
      $page=1;
    }
    
    $offset=($page-1)*$limit;
    
    
    $related_products = "SELECT prro.id,prro.name,prro.price,prro.count,prro.des,prro.cover,prro.date, cat.cat, brand.brand  FROM prro , cat, brand WHERE
    prro.cat=cat.id AND prro.brand=brand.id AND cat.cat='$cat' AND NOT prro.id ='$id' ORDER BY prro.id ASC LIMIT  $limit OFFSET $offset";
    $result_related = $conn->query($related_products);
    foreach($result_related as $related_data){
      $img= $related_data['cover'];
        $img_explode = explode(",",$img);
        $img_count = count($img_explode);
      $related_date =$related_data['date'];
      $related_date_num = strtotime($related_date);
      ?>
      <div class="col-lg-3 col-sm-12 col-md-6 mb-5">
        <div class="card shadow-lg w-100 h-100  <?php if($related_date_num > $time_num ){echo'new ';}?> hvr-pop ">
        <a href="?id=<?php echo $related_data['id']?>">
        <?php
      for ($i=0; $i <$img_count ; $i++) { 
        if($i==0){
      ?>
      <img src="../adminstrator/assets/images/<?php echo $img_explode[0]?>" class="w-100 h-100" alt="..." title="<?php echo $row['name'];?>" >
      <?php
      }
    }
      ?>
    </a>
  
      </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>


    <div class="container mb-5">
      <div class="text-center">
      <div class="    d-inline-block ">
      <?php
        $pagination ="SELECT COUNT(cover) FROM prro,cat,brand WHERE prro.cat=cat.id AND prro.brand=brand.id AND cat.cat='$cat' AND NOT prro.id ='$id'";
        $result_pagination= $conn-> query($pagination);
        foreach ($result_pagination as $row_pag) {
          $count_rows = $row_pag['COUNT(cover)'];
          $result_per_page = $count_rows / $limit;
          $ceil_page = ceil($result_per_page);
          if($page>1){
            ?>
            <a href="<?php
            if (isset($_GET['id'])) {
              echo '?page='.($page-1) .'&id='.$id.'';
            }
            ?>
            "
            class="category  hvr-pop shadow mt-1 ">Pervious</a>
            <?php
          }
          for ($t=1; $t <=$ceil_page ; $t++) { 
            ?>
            <a href="
            <?php
            if (isset($_GET['id'])) {
              echo '?page='.($t).'&id='.$id.'';
            }
            ?>
            "
            class="category  hvr-pop shadow mt-1 <?php if($t==$_GET['page']||($t==1 && !isset($_GET['page']))){echo'ac';}?>"><?=$t?></a>
            <?php
          }
          if($t>$page+1  ){
            ?>
            <a href="
            <?php
             
            if (isset($_GET['id'])) {
              echo '?page='.($page+1).'&id='.$id.'';
            }
            ?>
            "
            class="category  hvr-pop shadow mt-1 ">Next</a>
            <?php
          }
        }
        ?>
      </div>
      </div>
    </div>
     
<?php

include "include files/foot.php";
?>
