<?php
namespace App\Enums;


enum OrderStatus: string
{
    case Unpaid = 'unpaid';

    case Completed = 'completed';

    public static function getStatuses()
    {
        return [
             self::Unpaid, self::Completed
        ];
    }
}
