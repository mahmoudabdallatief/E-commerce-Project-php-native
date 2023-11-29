
<nav
             id="sidebarMenu"
             class="collapse d-lg-block sidebar collapse" style=
             >
          <div class="position-sticky wow  mx-auto">
            <ul class="list-group list-group-flush mx-0" id="myDIV">
            
                <li class="   mb-2 "> <a   
                 href="dashboard.php"
                 class="list-group-item list-group-item-action  <?php if($pagename == 'Dashboard'){echo'active';} ?>"
                 aria-current="true"
                 >
                 <i class="fa-solid fa-gauge-high fa-fw me-3"></i>
                 <span>Dashboard</span>
              </a></li>
                <li class="   mb-2 ">
                <a 
                 href="products.php"
                 class="list-group-item list-group-item-action  <?php if($pagename == 'Products'){echo'active';}?>"
                 >
                 <i class="fa-brands fa-product-hunt fa-fw me-3"></i>
                 <span>All Products</span>
              </a>
                </li>
                
                <li  class="   mb-2 ">
                <a 
                 href="brands.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Brands'){echo'active';}?>"
                 >
                 <i class="fa-brands fa-bandcamp  fa-fw me-3"></i>
                 <span>All Brands</span>
              </a>
                </li>
               
                <li  class="   mb-2 " >
                <a 
                 href="category.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Category'){echo'active';}?>"
                 >
                 <i class="fa-solid fa-list fa-fw me-3"></i>
                 <span>All Category</span>
              </a>
                </li>

                <li  class="   mb-2 " >
                <a 
                 href="admin.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Admins'){echo'active';}?>"
                 >
                 <i class="fa-solid fa-lock fa-fw me-3"></i>
                 <span>Admins</span>
              </a>
                </li>
                <li  class="   mb-2 " >
                <a 
                 href="message.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Messages'){echo'active';}?>"
                 >
                 <i class="fa-regular fa-message fa-fw me-3"></i>
                 <span>Messages</span>
              </a>
                </li>
                <li  class="   mb-2 " >
                <a 
                 href="comment.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Comments'){echo'active';}?>"
                 >
                 <i class="fa-solid fa-comment fa-fw me-3"></i>
                 <span>Comments</span>
              </a>
                </li>
                <li  class="   mb-2 " >
                <a 
                 href="orders.php"
                 class="list-group-item list-group-item-action <?php if($pagename == 'Orders'){echo'active';}?>"
                 >
                 <i class="fa-solid fa-cart-shopping   fa-fw me-3"></i>
                 <span>Orders</span>
              </a>
                </li>
              </ul>
          </div>
        </nav>
        