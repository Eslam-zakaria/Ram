<?php


namespace App\Constants;


final class Roles
{
    public const CUSTOMER = 1;
    public const ADMIN  = 2;
    public const SUPERVISOR  = 3;
    public const DEPUTY_SUPERVISOR  = 4;
    public const AGENT_A  = 5;
    public const AGENT  = 6;

    public static function getList()
    {
        return [
            self::CUSTOMER => 'Customer',
            self::ADMIN => 'Administrator',
            self::SUPERVISOR => 'Supervisor',
            self::DEPUTY_SUPERVISOR => 'Deputy supervisor',
            self::AGENT_A => 'Agent A',
            self::AGENT => 'Agent B',
        ];
    }

    public static function getLabel($key)
    {
            return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
