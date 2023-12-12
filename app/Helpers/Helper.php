<?php

namespace App\Helpers;

class Helper
{
    public static function numberGenerator(int $length, int $code)
    {
        return str_pad($code, $length, '0', STR_PAD_LEFT);
    }
    
    public static function calculateExpiry(int $value, string $type, string $time)
    {
        return date('Y-m-d H:i:s', strtotime("+$value $type", $time));
    }

    public static function codeGenerator(string $prefix, int $digit, int $id)
    {
        return $prefix . '-' .  Helper::numberGenerator($digit, $id);
    }
}