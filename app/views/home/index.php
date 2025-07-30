<?php 
    if(!isset($_SESSION['is_logged_in']) ) {
        header("Location: ?page=login");
        exit();
    }

    include dirname(__DIR__, 2) . '/layouts/header.php';
?>

<div class="container mt-5">
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
    <?php else: ?>
        <h1>Welcome to the Home Page!</h1>
    <?php endif; ?>
</div>

<?php 
    include dirname(__DIR__, 2) . '/layouts/footer.php';
?>