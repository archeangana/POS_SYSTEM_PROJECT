<?php 
      if(!isset($_SESSION['is_logged_in']) || $_SESSION['is_admin'] !== true ) {
            header("Location: /");
            exit();
      }
      include 'layouts/header.php'; 
?>
      <?php
            include 'dashboard/index.php';
      ?>
<?php include 'layouts/footer.php'; ?>
