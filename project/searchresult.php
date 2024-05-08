<?php
session_start();
include "include files/connect.php";
@$session = $_SESSION['login'];
$search = trim($_GET['search_query']);
$ignoredValue = mysqli_real_escape_string($conn, $search); 

if (empty($search) || $search === '') {
  // If the search query is empty or contains only spaces, redirect back to the previous page
  if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
  } else {
    header("Location: products.php"); // or any other default page
  }
  exit();
} else {
  $pagename = $search;
}


include "include files/header.php";
include "include files/nav.php";
$time = date('m/d/Y H:i:s', time());
$time_num= strtotime($time)+3600;
$limit=05;


if(isset($_GET["page"]))
{
  $page=$_GET["page"];
}
else
{
  $page=1;
}

$offset=($page-1)*$limit
?>
<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-12 mb-5 search-head h5">
   </div>
<?php

if( !empty($ignoredValue)  ){
    $sql = "SELECT prro.id, prro.name, prro.cover, prro.date, prro.price, prro.offer
FROM prro 
JOIN cat ON prro.cat = cat.id 
WHERE prro.name LIKE '%$ignoredValue%' 
  OR cat.cat LIKE '%$ignoredValue%'  
  OR cat.cat = '$ignoredValue' 
  OR prro.name = '$ignoredValue' 
UNION
SELECT p.id, p.name, p.cover, p.date, p.price, p.offer
FROM prro p
JOIN cat c ON p.cat = c.id
WHERE c.cat IN (
  SELECT cat
  FROM cat
  WHERE parent = (
    SELECT id
    FROM cat
    WHERE cat = '$ignoredValue' OR cat LIKE '%$ignoredValue%'
    ORDER BY id
    LIMIT 1
  )
)
ORDER BY id
LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
@$num =$result->num_rows;
foreach($result as $row){
 $id= $row['id'];
  $date= $row['date'];
  $date_num= strtotime($date);
?>
<div class="col-12   ">
    <div class="card p-2 mt-3 mb-5 product">
        <div class="row g-0">
            <div class="col-md-4 ">
                <?php
                $image =$row['cover'];
                $explode =explode(",",$image);
                for ($i=0; $i <count($explode) ; $i++) { 
                    if($i==0){
                    ?>
                    <div class="w-100 <?php if($date_num > $time_num ){echo'new ';}?>">
                    <a href="single.php?id=<?=$row['id']?>" >
                    <img class="w-100 " src="../adminstrator/assets/images/<?=$explode[0]?>" title="<?=$row['name']?>">
                    </a>
                    </div>
                  
                    <?php
                }
            }
                ?>
            </div>
            <div class="col-md-8 ps-md-3 ps-lg-3 mt-3">
            <h4><b class="text-light">Product : </b><a href="single.php?id=<?=$row['id']?>" class="text-decoration-none searchproduct" style="color:gold"><?=$row['name']?></a></h4>
            <p class="mt-4"><b class="text-light">Price :</b> <span class="<?php if($date_num > $time_num){echo'text-decoration-line-through';}
  ?>"><?php echo $row['price']?> $.</span></p>
       <?php
       if($date_num > $time_num ){
       ?>
       <p class="mt-4"><b class="text-light">Offer : </b> <?=$row['offer']?> $.</p>
       <?php
      }
       ?>
       <div class="rate my-4">
    <?php
    $rate = "SELECT AVG(rating), COUNT(product_id) FROM ratings WHERE product_id ='$id' ";
    $res_rate =$conn -> query($rate);
    foreach($res_rate as $row_rate){
    if($row_rate['COUNT(product_id)']==0){
      
      ?>
      
<span style="color:gold !important;"><span style="color:#fff !important;"><b>Product Rating :</b></span> 0 </span>
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
        </div>
        
    </div>
</div>
<?php

}
}
?>

    </div>
</div>
<?php
if(!empty($ignoredValue)   && $num ){
?>
<div class="container mb-5 mt-5">
<div class="text-center">

      <div class="   d-inline-block ">
      <?php
      
        @$pagination ="SELECT COUNT(*) AS count FROM (
          SELECT prro.id
          FROM prro 
          JOIN cat ON prro.cat = cat.id 
          WHERE prro.name LIKE '%$ignoredValue%' 
            OR cat.cat LIKE '%$ignoredValue%'  
            OR cat.cat = '$ignoredValue' 
            OR prro.name = '$ignoredValue' 
          UNION
          SELECT p.id
          FROM prro p
          JOIN cat c ON p.cat = c.id
          WHERE c.cat IN (
            SELECT cat
            FROM cat
            WHERE parent = (
              SELECT id
              FROM cat
              WHERE cat = '$ignoredValue' OR cat LIKE '%$ignoredValue%'
              ORDER BY id
              LIMIT 1
            )
          )
      ) AS count_table";
  
        $result_pagination= $conn-> query($pagination);
        foreach ($result_pagination as $row_pag) {
          $count_rows = $row_pag['count'];
          $result_per_page = $count_rows / $limit;
          $ceil_page = ceil($result_per_page);
          
          if($count_rows>$limit ){
          
          if($page>1){
            ?>
            <a href="<?php
            if (isset($_GET['search_query'])) {
              echo '?page='.($page-1) .'&search_query='.$search.'';
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
            <?php  if (isset($_GET['search_query'])) {
              echo '?page='.$n .'&search_query='.$search.'';
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
             if (isset($_GET['search_query'])) {
              echo '?page='.($page+1) .'&search_query='.$search.'';
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
      }

        ?>
         
        </div>
        </div>  
</div>
<?php
}
if(!$num){
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 ">
            <div style="color:crimson; margin:120px auto 160px auto; text-align:center;  letter-spacing: 5px; font-size:30px; text-transform:uppercase;">Data NoT Found</div>
            </div>
        </div>
    </div>
      
        <?php
    
        }
        


include "include files/foot.php";
?>