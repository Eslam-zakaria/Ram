<?php


namespace App\Constants;


final class AvailableDays
{
    public const SUNDAY = 0;
    public const MONDAY = 1;
    public const TUESDAY = 2;
    public const WEDNESDAY = 3;
    public const THURSDAY = 4;
    public const FRIDAY = 5;
    public const SATURDAY = 6;


    public static function getList()
    {
        return [
            self::SUNDAY => 'messages.sunday',
            self::MONDAY => 'messages.monday',
            self::TUESDAY => 'messages.tuesday',
            self::WEDNESDAY => 'messages.wednesday',
            self::THURSDAY => 'messages.thursday',
            self::FRIDAY => 'messages.friday',
            self::SATURDAY => 'messages.saturday',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
