<nav
             id="main-navbar"
             class="navbar navbar-expand-lg navbar-light fixed-top shadow"
             >
          <!-- Container wrapper -->
          <div class="container-fluid">
            <!-- Toggle button -->
            <button
                    class="navbar-toggler"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                    >
              <i class="fas fa-bars"></i>
            </button>
      
            <!-- Brand -->
            <a class="navbar-brand" href="">
            <img src="./assets/images/34583214-logo-admin-icon-administrator-illustration-of-a-man-in-a-jacket-and-shirt-ties-jacket-and-shirt-.webp" alt="" width="70" height="70">
            </a>

      <div class="d-flex  ">
      <div class=" d-block ms-1 mt-3  " style ="background-color: chocolate !important;">
      <a href="message.php" class="notification">
  <span>
    <i class="fa-solid fa-earth-asia fa-fw"></i>
</span>
  <span class="badge bg-danger message text-white ">
  <?php
  include './sql/connect.php';
  $sql_msg = "SELECT COUNT(view) FROM message WHERE view = 0  " ;
      
  $result_msg = $conn -> query($sql_msg);
   while($row_msg =$result_msg -> fetch_assoc()){
echo $row_msg['COUNT(view)'];
   }
  ?>
  </span>
</a>
                </div>
                
            <ul class=" d-block  mt-3 mx-0">
           

          <li class="   ">
                <a   
                 href="logout.php"
                 class="list-group-item list-group-item-action  "
                 >
                 <i class="fa-solid fa-arrow-right-from-bracket "></i>
                 <span class="me-2">Log out</span></a
                >
                </li>
            
                
          </ul>
      </div>
            
          </div>
         
          <!-- Container wrapper -->
        </nav>
       