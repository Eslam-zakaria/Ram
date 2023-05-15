<?php


namespace Modules\Lead\Constants;


final class LeadStatus
{
    public const PENDING = 0;
    public const Confirmed  = 1;
    public const NotConfirmed  = 2;
    public const Winner  = 3;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::Confirmed => 'Confirmed',
            self::NotConfirmed => 'Not Confirmed',
            self::Winner => 'Winner',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
