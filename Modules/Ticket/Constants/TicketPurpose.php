<?php


namespace Modules\Ticket\Constants;


final class TicketPurpose
{
    public const BOOKING = 1;
    public const DOCTOR  = 2;
    public const DATE  = 3;
    public const OTHER  = 4;
    public const SUBSCRIBTON  = 5;
    public const CONTACTUS  = 6;

    public static function getList()
    {
        return [
            self::BOOKING => 'messages.BOOKING_ISSUE',
            self::DOCTOR => 'messages.DOCTOR_ISSUE',
            self::DATE => 'messages.DATE_ISSUE',
            self::OTHER => 'messages.OTHER_ISSUE',
            self::SUBSCRIBTON => 'SUBSCRIPTION',
            self::CONTACTUS => 'CONTACTUS',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? trans(self::getList()[$key]) : " ";
    }
}
