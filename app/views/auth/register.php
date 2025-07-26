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
                    <h2 class="card-title text-center mb-4">Sign Up</h2>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="page" value="register">
                        <input type="hidden" name="action" value="register">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span>Already have an account?</span>
                        <a href="index.php?page=login" class="link-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
?>