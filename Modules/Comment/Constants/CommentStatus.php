<?php

namespace Modules\Comment\Constants;

class CommentStatus
{
    public const PENDING = 1;
    public const APPROVED = 2;
    public const DISAPPROVED  = 3;

    public static function getList()
    {
        return [
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::DISAPPROVED => 'Disapproved',
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : " ";
    }
}
