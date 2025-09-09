<?php 
    if(!isset($_SESSION['is_logged_in']) ) {
        header("Location: ?page=login");
        exit();
    }

    include dirname(__DIR__, 2) . '/layouts/header.php';
?>

<div class="container mt-5 text-center">
    <?php if (isset($_SESSION['user'])): ?>
        <h1 class="">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
        <p class="text-muted fs-5 ">This is for Demo Purpose only</p>
    <?php else: ?>
        <h1>Welcome to the Home Page!</h1>
    <?php endif; ?>
</div>

<?php 
    include dirname(__DIR__, 2) . '/layouts/footer.php';
?>