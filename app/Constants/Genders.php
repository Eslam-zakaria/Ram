<?php


namespace App\Constants;


final class Genders
{
    public const FEMALE  = 1;
    public const MALE = 2;

    public static function getList()
    {
        return [
            self::FEMALE => 'For Her',
            self::MALE => 'For Him',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
