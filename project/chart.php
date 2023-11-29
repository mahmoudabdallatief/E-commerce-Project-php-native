<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
session_start();
if(!isset($_SESSION['login'])){
  header("Location:products.php");
  exit();
}
@$session =$_SESSION['login'];
$pagename = "Cart";

include "include files/connect.php";
include "include files/header.php";
include "include files/nav.php";

$time = date('m/d/Y H:i:s', time());
$time_num= strtotime($time)+3600;

$cart = "SELECT * FROM chart WHERE id_user='$session' ORDER BY id ASC";
$result_cart = $conn->query($cart);
foreach ($result_cart as $row_cart) {
  $quantity_cart = $row_cart['quantity'];
  $id_cart = $row_cart['id'];
  $id_product_cart = $row_cart['id_pro'];
  $product ="SELECT date,offer,price FROM prro WHERE id ='$id_product_cart'";
           $res_product = $conn->query($product);
           foreach ($res_product as $row_product){
            $date_product= $row_product['date'];
            $offer_product= $row_product['offer'];
            $price_product = $row_product['price'];
            $date_product_num= strtotime($date_product);
            if($date_product_num > $time_num){
              $total =$offer_product*$quantity_cart;
$update_cart ="UPDATE chart SET  total ='$total' WHERE id ='$id_cart'";
$conn->query($update_cart);
            }
            else{
              $total =$price_product*$quantity_cart;
              $update_cart ="UPDATE chart SET  total ='$total' WHERE id ='$id_cart'";
$conn->query($update_cart);
            }
}    
}
?>
<div class="container my-5">
  <div class="row">
  <h2 class="h5 col-12 shop-heading mb-5"></h2>
    <div class="col-lg-8 mb-4 mb-lg-0 cart-con">
      <?php
      $sql_chart = "SELECT * FROM chart WHERE id_user='$session' ORDER BY id DESC";
      $result = $conn->query($sql_chart);
      $num = $result->num_rows;
      if ($num == 0) {
        echo '<p class="text-center w-100 p-3" style="background-color:crimson; color:gold;border-radius:25px;box-shadow: 1px 1px 5px #969191fa, -1px -1px 5px #969191fa;border:1px solid gold;">No Products Added To Cart</p>';
      } else {
        foreach ($result as $row) {
          $quantity = $row['quantity'];
          $id_pro = $row['id_pro'];
          $id = $row['id'];
       
      ?>
          <div class="row mb-5   product" id="h<?= $row['id'] ?>">
          <?php
           $sql_date ="SELECT * FROM prro WHERE id ='$id_pro'";
           $res_date = $conn->query($sql_date);
           foreach ($res_date as $row_date){
            $date= $row_date['date'];
            $offer= $row_date['offer'];
            $date_num= strtotime($date);
            ?>
          
            <div class="col-md-4 pt-3">
              <div class="w-100 <?php if($date_num > $time_num ){echo'new ';}?>">
              <?php
              $img= $row_date['cover'];
              $img_explode = explode(",",$img);
              $img_count = count($img_explode);
      for ($i=0; $i <$img_count ; $i++) { 
        if($i==0){
      ?>
                <a href="single.php?id=<?= $row['id_pro'] ?>">
                  <img class="w-100 mb-3" style="border-radius: 25px;" src="../adminstrator/assets/images/<?= $img_explode[0]?>" title="<?= $row_date['name'] ?>">
                </a>
                <?php
      }
    }
      ?>
              </div>
            </div>
            <div class="col-md-8 pt-4 p-3">
              <h4><b class="text-light">Product : </b><a href="single.php?id=<?= $row['id_pro'] ?>" class="text-decoration-none searchproduct my-3" style="color:gold"><?= $row_date['name'] ?></a></h4>
              <br>
              <p class="mb-3 price"><b class="text-light">Price : </b>
              <span class="<?php if($date_num > $time_num){echo'text-decoration-line-through';}
  ?>"><?php echo $row_date['price'];?> $.</span></p>
               <?php if($date_num > $time_num){
    ?>
    <p class="mt-4" style="width:fit-content;"><b class="text-light" >Offer : </b ><?=$offer;?> $.</p>
    <?php
    }?>
              <div class="rate my-3">
                <?php
                $rate = "SELECT AVG(rating), COUNT(product_id) FROM ratings WHERE product_id ='$id_pro' ";
                $res_rate = $conn->query($rate);
                foreach ($res_rate as $row_rate) {
                  if ($row_rate['COUNT(product_id)'] == 0) {
                ?>
                    <span style="color:gold !important;"><span style="color:#fff !important;"><b>Product Rating :</b> </span> 0 </span>
                  <?php } else {
                    $round = round($row_rate['AVG(rating)']);
                  ?>
                    <span class="me-2" style="color:#fff !important;"><span class="me-2" style="color:#fff !important;"><b>Rating For This Product :</b></span> <?php for ($s = 1; $s <= 5; $s++) { ?>
                        <i class="fa fa-star fa-1x " style="<?php if ($s <= $round) {
                                                              echo 'color: gold !important;';
                                                            } ?>" data-index="<?= $s ?>"></i>
                    <?php
                      }
                    ?> Based on <?= $row_rate['COUNT(product_id)'] ?> Rating</span>
                <?php
                  }
                }
                ?>
                  </div>
                <div class="align-middle border-0 mb-4  m-auto">
                  <br>
                  <div class="border d-flex align-items-center justify-content-center px-3" style="border:1px solid gold !important;">
                    <span class=" text-uppercase   headings-font-family " style="color:#fff !important;font-weight:bold!important;">Quantity</span>
                    <div class="quantity">
                      <button class="dec-btn send p-0" name="action" type="button"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control form-control-sm border-0 shadow-0 p-0 num" name="quantity" type="number" value="<?= $quantity;?>" min="1" max="<?=$row_date['count']?>"                                                                                                                  
                      >
                      <input type="hidden" class="max" value="<?=$row_date['count']?>">
                      <input type="hidden" class="price" name="price" value="<?php if($date_num > $time_num ){
                echo $offer;
              }else{
                echo $row_date['price'];
              } ?>">
                      <input type="hidden" class="id" name="id" value="<?= $id ?>">
                      <button class="inc-btn send p-0" name="action" type="button"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <p class="mb-2 total" id="a<?= $id ?>"><b class="text-light">Total :</b> <?=$row['total'] ?> $.</p>
                <b class="mb-2 text-light">Remove This Product :</b>
                <button class="btn mb-1 " data-bs-toggle="modal" data-bs-target="#examplemodel<?php echo $row['id']; ?>">
                  <i class="fa-solid fa-trash-can p-2 rounded" style="color:crimson; background-color:gold; border:1px solid #fff;"></i>
                </button>
                <div class="modal fade" id='examplemodel<?php echo $row['id']; ?>' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel"><b>Are Yoy Sure You Want To Delete?</b> </h5>
                      </div>
                      <div class="modal-body">
                        <p class="text-start text-dark">
                          <?php echo $row['name']; ?>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" value="<?= $row['id'] ?>" name="delid" class="delid">
                        <button type="button" class="btn login btn-del" data-bs-dismiss="modal">DELETE</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
          
      <?php
        }
      }
    }
      ?>
      <?php if ($num != 0) { ?>
        <div class="my-3 delall text-center">
          <button class="btn del_all" data-bs-toggle="modal" data-bs-target="#examplemodel">Delete All Products From Cart</button>
        </div>
      <?php
      } ?>
       </div>
      <div class="modal fade" id='examplemodel' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Are Yoy Sure You Want To Delete?</b> </h5>
            </div>
            <div class="modal-body">
              <p class="text-start">
              All Products From Cart
                </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a class="text-decoration-none" href="deleteallfromchart.php?user_id=<?=$session?>"><button type="button" class="btn del_all">DELETE</button></a>
                      </div>
                </div>
                  </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0 ">
              <div class="card  border-0 rounded-0 p-lg-4 custom-cart "style="box-shadow: 1px 1px 5px #969191fa, -1px -1px 5px #969191fa;">
                <div class="card-body  pt-1 ">
                  <h5 class="text-uppercase mb-4 pt-1 text-light">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between mb-3"><strong class="text-uppercase text-light font-weight-bold">Sum Total</strong><span class="text-muted tot " id="co"><?php
                    $sum ="SELECT SUM(total) FROM chart WHERE id_user=$session";
                    $result_sum = $conn->query($sum);
                    foreach ($result_sum as $row_sum) {
                        echo $row_sum['SUM(total)'];
                        if($row_sum['SUM(total)']==NULL){
                          echo 0;
                        }
                    }
                    ?> $.</span></li>
                     <li class="coupon-item">
                     <?php if ($num != 0) { ?>
                        <div class="form-group coupon mb-0">

                          <button class="btn  coupon-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fas fa-gift mr-2"></i> Check Out</button>
                        </div>
                        <?php
      } else{?>
                       
                         <br>
                         <br>
                         <br>
                         <?php
      } ?>
                        </li>
                        
                  </ul>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:crimson !important;" id="staticBackdropLabel">Check-Out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="checkout-Form" >
  
  <h3 class="bill">Billing Information</h3>
  <div class="row">
    <div class="col-12">
      <label for="billing_name">Name:</label>
      <input type="text" name="billing_name" id="billing_name" class="w-100 form-control">
      <div class="name_err">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="billing_address">Address:</label>
      <input type="text" name="billing_address" id="billing_address" class="w-100 form-control">
      <div class="address_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="billing_city">City:</label>
      <input type="text" name="billing_city" id="billing_city" class="w-100 form-control">
      <div class="city_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="billing_state">State:</label>
      <input type="text" name="billing_state" id="billing_state" class="w-100 form-control">
      <div class="state_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="billing_zip">Zip Code:</label>
      <input type="text" name="billing_zip" id="billing_zip" class="w-100 form-control">
      <div class="zip_err"></div>
    </div>
  </div>

  <h3 class="bill">Shipping Information</h3>
  <div class="row">
    <div class="col-12">
      <label for="shipping_name">Name:</label>
      <input type="text" name="shipping_name" id="shipping_name" class="w-100 form-control ">
      <div class="shipping_name_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="shipping_address">Address:</label>
      <input type="text" name="shipping_address" id="shipping_address" class="w-100 form-control">
      <div class="shipping_address_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="shipping_city">City:</label>
      <input type="text" name="shipping_city" id="shipping_city" class="w-100 form-control">
      <div class="shipping_city_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="shipping_state">State:</label>
      <input type="text" name="shipping_state" id="shipping_state" class="w-100 form-control ">
      <div class="shipping_state_err"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <label for="shipping_zip">Zip Code:</label>
      <input type="text" name="shipping_zip" id="shipping_zip" class="w-100 form-control ">
      <div class="shipping_zip_err"></div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn login">Place Order</button>
  </div>
  
</form>
</div>

              </div>
              
            </div>        
              
                </div>
              </div>
            </div>
            </div>
            </div>
    </div>
</div>
                     


      <?php
include "include files/foot.php";
?>