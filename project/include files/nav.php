<div class="navContainer "style="<?php if($pagename == "Products"){echo 'margin-top:-110px;';}?>">

  <?php
  @$session=$_SESSION['login'];?>
<nav class="navbar navbar-expand-lg navbar-dark  <?php if($pagename != "Products"){echo 'crimson';}?>">
        <div class="container ">
          
          <a class="navbar-brand" href="#">
          <img src="slider-images/images.png "  alt="">
        </a>
        <form class="d-block  d-flex input-group my-auto w-auto my-auto position-relative" id="search-form" action="searchresult.php" method="get">
           
           <input
           name="search_query" id="search-query"
                  autocomplete="off"
                type="text"
                  class="form-control rounded in  "
                  placeholder='Search '
                  style="width: 225px; color:crimson;"
                  />
  
                  <button type='submit' class="input-group-text border-0 rounded-1 addtochart"
                 >
                 <i class="fas fa-search icon_search" ></i>
                     </button>
    
                     <ul id="search-results" class="text-left position-absolute">
   
   </ul>
         </form>
          <button class="btn  navbar-toggler addtochart" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          <i class="fa-solid fa-bars"></i>
        </button>
          <div class="offcanvas  offcanvas-start-lg" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" aria-hidden="true" >
            <div class="offcanvas-header d-flex  d-lg-none " >
             <a class="navbar-brand" href="#">
             <img src="slider-images/images.png "  alt="">
              </a>
              <a href="javascript:void(0) " class="text-reset p-0" data-bs-dismiss="offcanvas" aria-label="close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gold" class="bi bi-x-circle  x-button" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
              </a>
            </div>
            <div class="offcanvas-body p-lg-0 ">
             
            <div class="navbar-nav ms-auto my-auto ">
              <!-- Search form -->
         
        <a class="nav-link py-2 px-3 mx-lg-3 <?php if($pagename == 'Products'){echo'active';}?>  cat" aria-current="page" href="products.php">Home</a>
        <?php
        if($_SERVER['REQUEST_METHOD']=='GET' && ($pagename == @$search)){
          ?>
          <a class="nav-link py-2 px-3 mx-lg-3  active cat" aria-current="page" href="searchresult.php?search_query=<?=$search?>">Search</a>
          <?php
        }
        if($pagename=='Single-Product'){
          ?>
          <a class="nav-link py-2 px-3 mx-lg-3 cat <?php if($pagename == 'Single-Product'){echo'active';}?> " href="single.php?id=<?php
          if(isset($id)){
            echo $id;
          }
          
          ?>">Single-Product</a>
          <?php
        }
        ?>
        <!-- <a class="nav-link py-2 px-3 mx-lg-3 cat " href="#">About</a> -->
        <a class="nav-link py-2 px-3 mx-lg-3 cat <?php if($pagename == 'Contact'){echo'active';}?> " href="contact.php">Contact</a>
        <?php if ( isset($_SESSION['login'])){?>
        <a class="nav-link py-2 px-3 mx-lg-3 text-center cat  <?php if($pagename == 'Cart'){echo'active';}?> d-inline-block" id="co" href="chart.php" tabindex="-1" aria-disabled="true">
          <?php $count_chart ="SELECT COUNT(id) FROM chart WHERE id_user ='$session' "; 
          $res_count_chart= $conn-> query($count_chart);
          foreach ($res_count_chart as $row_chart ) {
            echo $row_chart['COUNT(id)'];
          }
          
          ?>
          

          <i class="fa-solid fa-cart-shopping   d-inline-block"></i>
          
       
        </a>
        <a class="nav-link py-2 px-3 mx-lg-3 cat <?php if($pagename == 'Orders'){echo'active';}?> " href="orders.php">Orders</a>
        <a class="nav-link py-2 px-3 mx-lg-3 cat" href="logout.php" tabindex="-1" aria-disabled="true">Log out</a>
          <?php
          }
          else {
            ?>
              <a class="nav-link py-2 px-3 mx-lg-3 cat" href="signup.php" tabindex="-1" aria-disabled="true">Sign-up</a>
              <a class="nav-link py-2 px-3 mx-lg-3 cat" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
            <?php
          }
          ?>
          
       
            
      </div>
      
      </div>       
    
          
          </div>
          
        </div>
    
      </nav>
     
</div>


   
