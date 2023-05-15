<?php


namespace App\Constants;


final class Templates
{
    public const RAM = 'ram';
    public const BAHRIEN  = 'bh';

    public static function getList()
    {
        return [
            self::RAM => 'ram',
            self::BAHRIEN => 'bh',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
