<?php


namespace App\Constants;


final class BookingStatuses
{
    public const PENDING = 0;
    public const CONFIRMED  = 1;
    public const NOT_CONFIRMED  = 2;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::NOT_CONFIRMED => 'Not Confirmed',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
