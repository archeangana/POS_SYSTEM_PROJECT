<?php 
      if(!isset($_SESSION['is_logged_in']) ) {
            header("Location: ?page=login");
            exit();
      }
      include 'layouts/header.php'; 
?>
      <?php
            include 'dashboard/index.php';
      ?>
<?php include 'layouts/footer.php'; ?>
