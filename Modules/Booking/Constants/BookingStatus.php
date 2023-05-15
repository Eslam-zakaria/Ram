<?php


namespace Modules\Booking\Constants;


final class BookingStatus
{
    public const PENDING = 0;
    public const SENT  = 1;
    public const ERROR  = 2;
    public const DUPLICATED  = 3;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::SENT => 'Sent',
            self::ERROR => 'Error',
            self::DUPLICATED => 'Duplicate',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
