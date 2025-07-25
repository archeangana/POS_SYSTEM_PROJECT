<?php 
      session_start();
      if(!isset($_SESSION['is_logged_in']) ) {
          header("Location: ../app/views/auth/login.php");
          exit();
      }
?>


<h1>Welcome to Home</h1>