<?php
namespace App\Core\Helpers;

class ResponseJSON {

      public static function jsonResponse($status, $type, $message, $data = []) {
            if (ob_get_length()) ob_clean();
            header('Content-Type: application/json');

            $response = [
                  'status' => $status,
                  'status_type' => $type,
                  'message' => $message,
                  'data' => $data // Custom Data
            ];

            echo json_encode($response);
            exit;
      }


}