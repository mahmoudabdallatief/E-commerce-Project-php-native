<?php
$pagename = "Products";
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
session_start();
@$cat = $_GET['cat_id'];
include "include files/connect.php";
include "include files/header.php";
@$session = $_SESSION['login'];
include "include files/nav.php";
if(isset($session)){
  $message ="SELECT * FROM users WHERE id_user ='$session'";
  $result_mes =$conn-> query($message);
  foreach ($result_mes as $row_mes) {
    $username = $row_mes['username'];
    ?>
    <input type="hidden" class="session" value="<?=$username?>">
    
    <?php
  }
}
?>

<div class="swiper slide-con  position-relative">
<div class="swiper-wrapper ">
  
    <?php
    $img = array("image1", "image2", "image3", "image4");
    $arr = array(
        array(
            "title" => "Defining e-commerce",
            "par" => "The term was coined and first employed by Dr. Robert Jacobson, Principal Consultant to the California State Assembly's Utilities & Commerce Committee, in the title and text of California's Electronic Commerce Act, carried by the late Committee Chairwoman Gwen Moore (D-L.A.) and enacted in 1984.",
            "image" => $img[0] . ".jpg"
        ),
        array(
            "title" => "Forms",
            "par" => "Contemporary electronic commerce can be classified into two categories. The first category is business based on types of goods sold (involves everything from ordering \"digital\" content for immediate online consumption, to ordering conventional goods and services, to \"meta\" services to facilitate other types of electronic commerce). The second category is based on the nature of the participant (B2B, B2C, C2B and C2C).",
            "image" => $img[1] . ".jpg"
        ),
        array(
            "title" => "Governmental regulation",
            "par" => "In the United States, California's Electronic Commerce Act (1984), enacted by the Legislature, and the more recent California Privacy Rights Act (2020), enacted through a popular election proposition, control specifically how electronic commerce may be conducted in California. In the US in its entirety, electronic commerce activities are regulated more broadly by the Federal Trade Commission (FTC).",
            "image" => $img[2] . ".jpg"
        ),
        array(
            "title" => "Global trends",
            "par" => "In 2010, the United Kingdom had the highest per capita e-commerce spending in the world.[23] As of 2013, the Czech Republic was the European country where e-commerce delivers the biggest contribution to the enterprises' total revenue. Almost a quarter (24%) of the country's total turnover is generated via the online channel.",
            "image" => $img[3] . ".jpg"
        )
    );
    
    foreach ($arr as $key => $value) {
        $delay = $key * 5;
        echo '<div class="swiper-slide slide position-relative">';
        echo '<img src="slider-images/' . $value["image"] . '" alt="" class="wow animate__animated animate__fadeInLeftBig img-slide" data-wow-duration="2s" data-wow-delay="' . $delay . 's">';
        echo '<div class="position-absolute slide-text">';
        echo '<h3 class="wow animate__animated animate__fadeInDown mb-3" data-wow-duration="5s" data-wow-delay="' . $delay . 's"><b>' . $value["title"] . '</b></h3>';
        echo '<p class="wow animate__animated animate__fadeInUp" data-wow-duration="5s" data-wow-delay="' . $delay . 's">' . $value["par"] . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
<div class="swiper-button-prev sli-prev position-absolute "></div>
        <div class="swiper-button-next sli-next position-absolute "></div>
</div>

<h2 class="animation" id="typewriter">E-commerce Website</h2>

<div class="container my-2">
<section class="py-3">
<div class="container p-0">
 <div class="row">
<div class="col-lg-3 order-2 order-lg-1">
<ul class="list-unstyled small   w-100">
<li class="mb-2 mt-2 w-100"><a class="reset-anchor category hvr-pop w-100 shadow <?php if(!isset($_GET['cat_id'])){ echo'ac';}?> " href="products.php">ALL Products</a></li>
</ul>
             
<div class="w-100">
<?php
    $main_category= "SELECT * FROM cat WHERE parent = 0";
    $result_main=$conn->query($main_category);
    foreach($result_main as $main){
      $id_parent =$main['id'];
       
        ?>
  <h5 class=" mb-4 mt-5 head-cat shadow"><?= $main['cat']?></h5>

  <ul class="list-unstyled small  w-100">
                <?php
    $category= "SELECT * FROM cat WHERE parent = '$id_parent' ";
    $result_category=$conn->query($category);
    foreach($result_category as $row_cat){
        ?>

<li class="mb-2 mt-2 w-100 "><a class=" hvr-pop shadow w-100  category  <?php if($cat==$row_cat['id']){echo'ac';}?> " href="?cat_id=<?php echo $row_cat['id'];  ?>"><?php echo $row_cat['cat']; ?></a></li>
                  
  <?php
    }
    ?>
      </ul>
  <?php
  }
  ?>
  </div>
  </div>
              
<div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
               
<div class="row">
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


if(!isset($_GET['cat_id'])){
    $sql = "SELECT *  FROM prro   ORDER BY id ASC LIMIT  $limit OFFSET $offset" ;
}
else{
    $sql = "SELECT * FROM prro  WHERE   prro.cat='$cat'   ORDER BY id ASC LIMIT $limit OFFSET $offset" ;
}

      $result = $conn -> query($sql);
      foreach($result as $row){
        $img= $row['cover'];
        $img_explode = explode(",",$img);
        $img_count = count($img_explode);
        $time = date('m/d/Y H:i:s', time());
        $time_num= strtotime($time)+3600;
        $date= $row['date'];
        $date_num= strtotime($date);
        ?>
  <div class="col-lg-4 col-sm-6 mb-3">
   <div class=" card w-100 h-100 shadow-lg ">
    <div class="  h-100  <?php if($date_num > $time_num){echo'new';}?> hvr-pop">
      <a  href="single.php?id=<?php echo $row['id']?>">
                      <?php
      for ($i=0; $i <$img_count; $i++) { 
        if($i==0){
      ?>
      <img src="../adminstrator/assets/images/<?php echo $img_explode[0]?>" class=" w-100 h-100" alt="..." title="<?php echo $row['name'];?>" >
      <?php
      }
    }
      ?>
     </a>
   </div>
</div>
</div>
<?php
  }
  ?>
  <div class="col-12 d-flex justify-content-center my-5">
  <div class="   d-inline-block ">
      <?php
      if(isset($_GET['cat_id'])){
        $pagination ="SELECT COUNT(id) FROM prro WHERE cat ='$cat' ";
      }
      else{
        $pagination ="SELECT COUNT(id) FROM prro";
      }
  
        $result_pagination= $conn-> query($pagination);
        foreach ($result_pagination as $row_pag) {
          $count_rows = $row_pag['COUNT(id)'];
          $result_per_page = $count_rows / $limit;
          $ceil_page = ceil($result_per_page);
          if($page>1){
            ?>
            <a href="<?php
            if (isset($_GET['cat_id'])) {
              echo '?page='.($page-1) .'&cat_id='.$cat.'';
            }
            else{
              echo '?page='.($page-1) .'';
            }
            ?>
            "
            class="category  hvr-pop shadow mt-1 ">Pervious</a>
            <?php
          }
          for ($n=1; $n <=$ceil_page ; $n++) { 
            ?>
            <a href="
            <?php  if (isset($_GET['cat_id'])) {
              echo '?page='.$n .'&cat_id='.$cat.'';
            }
            else{
              echo '?page='.$n .'';
            }?>
            "
            class="category  hvr-pop shadow mt-1 <?php if($n==$_GET['page']||($n==1 && !isset($_GET['page']))){echo'ac';}?>"><?=$n?></a>
            <?php
          }
          if($n>$page+1  ){
            ?>
            <a href="
            <?php
             if (isset($_GET['cat_id'])) {
              echo '?page='.($page+1) .'&cat_id='.$cat.'';
            }
            else{
              echo '?page='.($page+1) .'';
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
 </div>
 </div>
</div>
</section>
</div>    

   
 
<?php
include "include files/foot.php";
?>

