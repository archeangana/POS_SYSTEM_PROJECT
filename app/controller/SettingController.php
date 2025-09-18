<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Company;
use App\Core\Helpers\Flash;

class SettingController extends Controller {

      public function indexAction() {

            $settings = (new Company())->getCompanyDetails();

            if(empty($settings)) {
                  $settings = [
                        'id' => '',
                        'company_name' => '',
                        'company_address' => ''
                  ];
            }
           
            $this->view('admin/settings/index', ['settings' => $settings]);
      }

      public function saveAction($data) {

            $companyModel = new Company();
            $existingSettings = $companyModel->getCompanyDetails();

            // Validate input and Sanitize
            $company_name = filter_var(trim($data['company_name']), FILTER_SANITIZE_STRING);
            $company_address = filter_var(trim($data['company_address']), FILTER_SANITIZE_STRING);

            if(empty($company_name)) {
                  $company_name = $existingSettings['company_name'];
            }

            if(empty($company_address)) {
                  $company_address = $existingSettings['company_address'];
            }

            // Check if settings exist, then update

            if($existingSettings) {
                  $data = [
                        'id' => $existingSettings['id'],
                        'company_name' => $company_name,
                        'company_address' => $company_address
                  ];
                  $result = $companyModel->updateCompanyDetails($data);
                  if($result) {
                        Flash::set('success', 'Updated Changes successfully.');
                        $this->redirectToPage('settings', 'index');
                  } else {
                        Flash::set('error', 'Update Failed.');
                        $this->redirectToPage('settings', 'index');
                  }
            } 
      }
    
}