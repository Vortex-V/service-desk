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
            self::New->value => 'Новая',
            self::InWork->value => 'В работе',
            self::Closed->value => 'Закрыта',
            self::Rejected->value => 'Отклонена',
        ];
    }

    public static function label(TicketStatus $value): string
    {
        return self::labels()[$value->value];
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
