<?php 
      // session_start();
      // if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
      //       header("Location: ../app/views/home.php");
      //       exit();
      // }
      include dirname(__DIR__, 2) . '/layouts/header.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    <form method="POST" action="../../../public/index.php">
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
                        <a href="../../../public/index.php?page=signup" class="link-primary">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

echo var_dump(array_flip(['page', 'action'])); // Outputs: ['John', 30]
include dirname(__DIR__, 2) . '/layouts/footer.php';

?>