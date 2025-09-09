<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Company;

class SettingController extends Controller {

      public function indexAction() {
           
            $this->view('admin/settings/index');
      }

      public function saveAction($data) {

      }
    
}