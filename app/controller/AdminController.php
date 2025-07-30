<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Helpers\BaseUrl;

class AdminController extends Controller {

      public function indexAction() {
            $this->view('admin/index');
      }

      public function adminAction() {

            $this->view('admin/index');
      }

      public function addAdminAction() {
            
      }

      public function createAdminAction() {
            $this->view('admin/index');
      }

      public function updateAction() {

      }

      public function deleteAction() {

      }

}