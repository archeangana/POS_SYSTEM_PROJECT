<?php

namespace App\Core\Helpers;

class BaseUrl {
      public static function getBaseUrl() {
            // Gets the Protocl
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
            // Gets the Domain
            $host = $_SERVER['HTTP_HOST'];
            // Gets the Current Running Directory File
            $scriptName = $_SERVER['SCRIPT_NAME'];

            // Remove index.php or similar from the script path
            $scriptDir = str_replace(basename($scriptName), '', $scriptName);
      
            return "{$protocol}://{$host}{$scriptDir}"; //"{$protocol}://{$host}{$scriptDir}";
      }
}
    

     