 <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
            <div class="nav">
                  <div class="sb-sidenav-menu-heading">Core</div>
                  <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
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


                  <!-- Pages -->
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                              </a>
                              <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="login.html">Login</a>
                                          <a class="nav-link" href="register.html">Register</a>
                                          <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                              </div>
                              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                              </a>
                              <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="401.html">401 Page</a>
                                          <a class="nav-link" href="404.html">404 Page</a>
                                          <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                              </div>
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
                        <div class="collapse" id="adminCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="?page=admin&action=create">Add Admin</a>
                                    <a class="nav-link" href="?page=admin&action=show">View Admins</a>
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