<?php

namespace App\Models\Ticket\Enum;

enum TicketStatus: string
{
    case New = 'new';
    case InWork = 'in_work';
    case Closed = 'closed';
    case Rejected = 'rejected';

    public static function labels(): array
    {
        return [
            self::New->name => 'Новая',
            self::InWork->name => 'В работе',
            self::Closed->name => 'Закрыта',
            self::Rejected->name => 'Отклонена',
        ];
    }

    public static function label(TicketStatus $value): string
    {
        return self::labels()[$value->name];
    }

    public static function statusMap(): array
    {
        return [
            self::New->name => [self::InWork, self::Rejected],
            self::InWork->name => [self::Closed],
            self::Closed->name => [],
            self::Rejected->name => [],
        ];
    }
}
