<?php 
      session_start();
      if(!isset($_SESSION['is_logged_in']) ) {
          header("Location: ?page=login");
          exit();
      }
?>

<h1>Welcome to Home</h1>
<a href="index.php?page=login&action=logout">Logout</a>