<?php

class Controller {

      public function handleError() {
            http_response_code(404);
            include './views/error/404.php';
            exit;
      }

      public function runAction($actionaName) {
            $actionaName .= 'Action';
            if(method_exists($this, $actionaName)) {
                  $this->$actionaName();
            } else {
                  $this->handleError();
            }
      }

}