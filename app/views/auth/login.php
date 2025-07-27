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
                        <?php if(isset($success) && $success) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo htmlspecialchars($success);
                                ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="page" value="login">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
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