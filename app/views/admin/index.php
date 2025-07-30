<?php include 'layouts/header.php'; ?>
      <?php

            $action = $_GET['action'] ?? $_POST['action'] ?? 'index';
            switch($action) {
                  case 'admin':
                        include 'layouts/admins/index.php';
                        break; 
                  case 'createAdmin':
                        include 'layouts/admins/create.php';
                        break;
                  case '':
                  default: 
                        include 'layouts/dashboard/index.php';
            }
      ?>
<?php include 'layouts/footer.php'; ?>
