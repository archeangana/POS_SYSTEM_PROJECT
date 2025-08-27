<?php 
      include dirname(__DIR__, 2) . '/layouts/header.php';
     
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 ">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4 fw-bold text-primary">Welcome Back</h2>
                      <p class="text-center text-muted mb-4">
                        Log in to access your account
                    </p>
                    <form method="POST" action="index.php">
                        <?php include dirname(__DIR__, 2) . '/components/notifications/flash.php';?>
                        <input type="hidden" name="page" value="login">
                        <input type="hidden" name="action" value="login">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control rounded-pill px-3 py-2" id="email" name="email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control rounded-pill px-3 py-2" id="password" name="password" required>
                        </div>

                        <!-- Remember me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <!-- Button -->
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm">
                            Login
                        </button>
                    </form>

                    <!-- Register link -->
                    <div class="mt-4 text-center">
                        <span class="text-muted">Don’t have an account?</span>
                        <a href="?page=register" class="fw-semibold text-decoration-none text-primary ms-1">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

