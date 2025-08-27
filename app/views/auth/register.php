<?php 
        include dirname(__DIR__, 2) . '/layouts/header.php';
        if(!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
                header("Location: ?page=home");
                exit();
        }
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4 fw-bold text-primary">Create Account</h2>
                    
                    <form method="POST" action="/">
                        <input type="hidden" name="page" value="register">
                        <input type="hidden" name="action" value="register">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <?php if(isset($errors) && !empty($errors)) : ?>
                            <div class="alert alert-danger rounded-3 shadow-sm" role="alert">
                                <?php 
                                    foreach ($errors as $error) {
                                        echo htmlspecialchars($error) . '<br>';
                                    }
                                ?>
                            </div>
                        <?php endif; ?>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control rounded-pill px-3 py-2" id="username" name="username">
                        </div>

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

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control rounded-pill px-3 py-2" id="confirm_password" name="confirm_password" required>
                        </div>

                        <!-- Button -->
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm">
                            Sign Up
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-4 text-center">
                        <span class="text-muted">Already have an account?</span>
                        <a href="?page=login" class="fw-semibold text-decoration-none text-primary ms-1">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

