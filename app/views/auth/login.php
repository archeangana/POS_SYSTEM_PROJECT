<?php 
      include dirname(__DIR__, 2) . '/layouts/header.php';
     
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    <form method="POST" action="index.php">
                        <?php include dirname(__DIR__) . '/components/notifications/flash.php';?>
                        <input type="hidden" name="page" value="login">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span>Don't have an account?</span>
                        <a href="?page=register" class="link-primary">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 


?>