<?php
require 'vendor/autoload.php'; // Ensure Composer's autoloader is included

use Ramsey\Uuid\Uuid;

if (!function_exists('generate_uuid')) {
    function generate_uuid() {
        return Uuid::uuid4()->toString();
    }
}
