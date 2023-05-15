<?php


namespace Modules\Lead\Constants;


final class InstallmentCompany
{
    public const TAMWEEL = 0;
    public const TASHEL = 1;

    public static function getList()
    {
        return [
            self::TAMWEEL => 'Tamweel-Aloula',
            self::TASHEL => 'Tashel',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }

    public static function getListAr()
    {
        return [
            self::TAMWEEL => 'التمويل اﻷولى',
            self::TASHEL => 'تسهيل',
        ];
    }

    public static function getLabelAr($key)
    {
        return array_key_exists($key, self::getListAr()) ? self::getListAr()[$key] : " ";
    }
}