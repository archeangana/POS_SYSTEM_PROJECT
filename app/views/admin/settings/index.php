<?php 
    if(!isset($_SESSION['is_logged_in']) || $_SESSION['is_admin'] !== true ) {
        header("Location: /");
        exit();
    }
    include dirname(__DIR__) . '/layouts/header.php'; 
?>
    
    <?php 
    
        $action = $_GET['action'] ?? 'index';

        switch($action) {
            case 'show':
                include 'index.php';
                break;
            case 'edit':
                include 'edit.php';
                break;
            case 'create':
                include 'create.php';
                break;
            default:
                  include 'company-details/show.php';
        }
    ?>

<?php include dirname(__DIR__) . '/layouts/footer.php'; ?>