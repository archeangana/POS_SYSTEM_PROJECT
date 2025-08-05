 <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                  <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="?page=admin">
                              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Dashboard
                        </a>
                        <a class="nav-link" href="?page=order&action=create">
                              <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                              Create Orders
                        </a>
                        <a class="nav-link" href="?page=admin">
                              <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                              Orders
                        </a>

                        <div class="sb-sidenav-menu-heading">
                              Interface
                        </div>
                        <!-- Product -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Products
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                              <nav class="sb-sidenav-menu-nested nav">
                              <a class="nav-link" href="?page=product&action=create">Create Prouct</a>
                              <a class="nav-link" href="?page=product&action=show">View Products</a>
                              </nav>
                        </div>
                        <!-- Category -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseLayouts">
                              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Categories
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                              <nav class="sb-sidenav-menu-nested nav">
                              <a class="nav-link" href="?page=category&action=create">Create Category</a>
                              <a class="nav-link" href="?page=category&action=show">View Categories</a>
                              </nav>
                        </div>
                  
                        <!-- Settings -->
                        <div class="sb-sidenav-menu-heading">Manage Users</div>
                              <!-- Admin -->
                              <a    
                                    class="nav-link collapsed" 
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
                              <div class="collapse" id="adminCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="?page=admin&action=create">Add Admin</a>
                                          <a class="nav-link" href="?page=admin&action=show">View Admins</a>
                                    </nav>
                              </div>
                              <!-- Customer -->
                              <a    
                                    class="nav-link collapsed" 
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
                              <div class="collapse" id="customerCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="?page=customer&action=create">Add Customer</a>
                                          <a class="nav-link" href="?page=customer&action=show">View Customers</a>
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