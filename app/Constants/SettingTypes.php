<?php


namespace App\Constants;


final class SettingTypes
{
    public const TEXT = 1;
    public const IMAGE  = 2;

    public static function getList()
    {
        return [
            self::TEXT => 'Text',
            self::IMAGE => 'Image',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
