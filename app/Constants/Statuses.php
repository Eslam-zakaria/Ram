<?php


namespace App\Constants;


final class Statuses
{
    public const DISABLED = 1;
    public const ACTIVE  = 2;

    public static function getList()
    {
        return [
            self::DISABLED => 'Disabled',
            self::ACTIVE => 'Active',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
