<?php

namespace App\Controller;
use App\Core\Controller;

class DashboardController extends Controller {

      public function indexAction() {

            $this->view('admin/dashboard/index');
      }


}