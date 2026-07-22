<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'Super Administrator';
    case CHURCH_ADMIN = 'Church Administrator';
    case PASTOR = 'Pastor';
    case FINANCE_OFFICER = 'Finance Officer';
    case MEDIA_DIRECTOR = 'Media Director';
    case MEMBER_MANAGER = 'Member Manager';
    case COMMUNICATIONS_OFFICER = 'Communications Officer';
    case VOLUNTEER = 'Volunteer';

    /**
     * Return all role values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
