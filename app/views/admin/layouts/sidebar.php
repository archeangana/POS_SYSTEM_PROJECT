 <?php 
      $page = $_GET['page'] ?? 'index';
      $action = $_GET['action'] ?? null;
 ?>

 <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                  <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link <?= $page == 'admin' && $action == null ? 'active' : ''?>" href="?page=admin">
                              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Dashboard
                        </a>
                        <a class="nav-link <?= $page == 'order' && $action == 'create' ? 'active' : ''?>" href="?page=order&action=create">
                              <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                              Create Orders
                        </a>
                        <a class="nav-link <?= $page == 'order' && $action == 'orders' ? 'active' : ''?>" href="?page=order&action=orders">
                              <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                              Orders
                        </a>

                        <div class="sb-sidenav-menu-heading">
                              Interface
                        </div>
                        <!-- Product -->
                        <a class="nav-link  <?= $page == 'product' ? 'collapse active' : 'collapsed'?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Products
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div 
                              class="collapse 
                                    <?= $page == 'product' && $action == 'create' ? 'show' : ''?>
                                    <?= $page == 'product' && $action == 'show' ? 'show' : ''?>" 
                              id="collapseProduct" 
                              aria-labelledby="headingOne" 
                              data-bs-parent="#sidenavAccordion"
                        >
                              <nav class="sb-sidenav-menu-nested nav">
                              <a 
                                    class="nav-link 
                                    <?= $page == 'product' && $action == 'create' ? 'active' : ''?>" 
                                    href="?page=product&action=create"
                              >
                                    Create Product
                              </a>
                              <a 
                                    class="nav-link 
                                    <?= $page == 'product' && $action =='show' ? 'active' : ''?>" 
                                    href="?page=product&action=show"
                              >
                                    View Products
                              </a>
                              </nav>
                        </div>
                        <!-- Category -->
                        <a 
                              class="nav-link  <?= $page == 'category' ? 'collapse active' : 'collapsed'?>" 
                              href="#" 
                              data-bs-toggle="collapse" 
                              data-bs-target="#collapseCategory" 
                              aria-expanded="false" 
                              aria-controls="collapseLayouts"
                        >
                              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Categories
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div 
                              class="collapse
                                    <?= $page == 'category' && $action == 'create' ? 'show' : ''?>
                                    <?= $page == 'category' && $action == 'show' ? 'show' : ''?>" 
                              id="collapseCategory" 
                              aria-labelledby="headingOne" 
                              data-bs-parent="#sidenavAccordion"
                        >
                              <nav class="sb-sidenav-menu-nested nav">
                              <a class="nav-link <?= $page == 'category' && $action == 'create' ? 'active' : ''?>" href="?page=category&action=create">Create Category</a>
                              <a class="nav-link <?= $page == 'category' && $action == 'show' ? 'active' : ''?>" href="?page=category&action=show">View Categories</a>
                              </nav>
                        </div>
                  
                        <!-- Settings -->
                        <div class="sb-sidenav-menu-heading">Manage Users</div>
                              <!-- Admin -->
                              <a    
                                    class="nav-link 
                                    <?= $page == 'admin' && $action == 'create' ? 'collapse active' : 'collapsed'?>
                                     <?= $page == 'admin' && $action == 'show' ? 'collapse active' : 'collapsed'?>" 
                                    href="#" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#adminCollapse" 
                                    aria-expanded="false" aria-controls="adminCollapse"
                              >
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                          Admins/Staff
                                    <div class="sb-sidenav-collapse-arrow">
                                          <i class="fas fa-angle-down"></i>
                                    </div>
                              </a>
                              <div 
                                    class="collapse
                                    <?= $page == 'admin' && $action == 'create' ? 'show' : ''?>
                                    <?= $page == 'admin' && $action == 'show' ? 'show' : ''?> " 
                                    id="adminCollapse" 
                                    aria-labelledby="headingOne" 
                                    data-bs-parent="#sidenavAccordion"
                              >
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link <?= $page == 'admin' && $action == 'create' ? 'active' : ''?>" href="?page=admin&action=create">Add Admin</a>
                                          <a class="nav-link <?= $page == 'admin' && $action == 'show' ? 'active' : ''?>" href="?page=admin&action=show">View Admins</a>
                                    </nav>
                              </div>
                              <!-- Customer -->
                              <a    
                                    class="nav-link
                                    <?= $page == 'customer' ? 'collapse active' : 'collapsed'?>
                                    " 
                                    href="#" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#customerCollapse" 
                                    aria-expanded="false" aria-controls="customerCollapse"
                              >
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                          Customers
                                    <div class="sb-sidenav-collapse-arrow">
                                          <i class="fas fa-angle-down"></i>
                                    </div>
                              </a>
                              <div class="collapse 
                                    <?= $page == 'customer' && $action == 'create' ? 'show' : ''?>
                                    <?= $page == 'customer' && $action == 'show' ? 'show' : ''?> " id="customerCollapse" 
                                    aria-labelledby="headingOne" 
                                    data-bs-parent="#sidenavAccordion"
                              >
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link <?= $page == 'customer' && $action == 'create' ? 'active show' : ''?>" href="?page=customer&action=create">Add Customer</a>
                                          <a class="nav-link <?= $page == 'customer' && $action == 'show' ? 'active show' : ''?>" href="?page=customer&action=show">View Customers</a>
                                    </nav>
                              </div>

                        </div>
                  </div>
            <!-- <div class="sb-sidenav-footer">
                  <div class="small">Logged in as:</div>
                  Start Bootstrap
            </div> -->
      </nav>
</div>