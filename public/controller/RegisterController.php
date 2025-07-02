<?php 


class RegisterController extends Controller {

    public function indexAction() {
        include './views/auth/signup.php';
    }

    public function registerAction() {
        // Handle registration logic here
        // For example, validate input, save to database, etc.
        include './views/successpage/success.php';
    }
}