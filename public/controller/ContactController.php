<?php

class ContactController extends Controller {

      public function indexAction() {
            include './views/contact/contact.php';
      }
      public function submitAction() {
            // Handle form submission logic here
            include './views/successpage/success.php';
      }
   
}
// End of ContactController.php