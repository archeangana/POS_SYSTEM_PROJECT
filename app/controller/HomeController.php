<?php

namespace App\Controller;
use App\Core\Controller;

class HomeController extends Controller {

      public function indexAction() {
            // This method can be used to handle the default action for the HomeController
            $title = 'Home';
            $data = ['title' => $title];
            $this->view('home/index', $data);
      }

      public function aboutAction() {
            // This method can be used to display an about page
            $this->view('home/about');
      }

}