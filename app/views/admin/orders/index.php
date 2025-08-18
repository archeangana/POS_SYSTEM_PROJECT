<?php 
    if(!isset($_SESSION['is_logged_in']) ) {
        header("Location: ?page=login");
        exit();
    }
    include dirname(__DIR__) . '/layouts/header.php'; 
?>
    
    <?php 
    
        $action = $_GET['action'] ?? 'show';

        switch($action) {
            case 'show':
                include 'show.php';
                break;
            case 'edit':
                include 'edit.php';
                break;
            case 'create':
                include 'create.php';
                break;
            case 'orderSummary':
                include 'order-summary.php';
                break;
            case 'orders':
                include 'order-list.php';
                break;
            case 'view':
                include 'view-order.php';
                break;
            default:
                echo 'No page found';
        }
    ?>

<?php include dirname(__DIR__) . '/layouts/footer.php'; ?>