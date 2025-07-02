<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
      <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                  <div class="card mb-4">
                        <div class="card-body">
                              <h2 class="card-title text-center mb-4">Signup</h2>
                              <form action="/index.php" method="POST">
                                    <input type="hidden" name="action" value="register">
                                    <input type="hidden" name="page" value="signup">

                                    <div class="mb-3">
                                          <label for="signup-email" class="form-label">Email</label>
                                          <input type="email" class="form-control" id="signup-email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                          <label for="signup-password" class="form-label">Password</label>
                                          <input type="password" class="form-control" id="signup-password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                          <label for="signup-confirm" class="form-label">Confirm Password</label>
                                          <input type="password" class="form-control" id="signup-confirm" name="confirm_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                              </form>
                        </div>
                        <label for="" class="text-center my-3">
                              <a href="index.php?page=login">Don't have an Account? Sign Up</a>
                        </label>
                  </div>
            </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>