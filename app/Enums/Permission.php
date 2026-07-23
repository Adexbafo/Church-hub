<?php

namespace App\Enums;

enum Permission: string
{
    // Members
    case MEMBERS_VIEW = 'members.view';
    case MEMBERS_CREATE = 'members.create';
    case MEMBERS_EDIT = 'members.edit';
    case MEMBERS_DELETE = 'members.delete';

        // Announcements
    case ANNOUNCEMENTS_VIEW = 'announcements.view';
    case ANNOUNCEMENTS_CREATE = 'announcements.create';
    case ANNOUNCEMENTS_EDIT = 'announcements.edit';
    case ANNOUNCEMENTS_DELETE = 'announcements.delete';

        // Media Library
    case MEDIA_VIEW = 'media.view';
    case MEDIA_CREATE = 'media.create';
    case MEDIA_EDIT = 'media.edit';
    case MEDIA_DELETE = 'media.delete';

        // Sermons
    case SERMONS_VIEW = 'sermons.view';
    case SERMONS_CREATE = 'sermons.create';
    case SERMONS_EDIT = 'sermons.edit';
    case SERMONS_DELETE = 'sermons.delete';

        // Livestreams
    case LIVESTREAMS_VIEW = 'livestreams.view';
    case LIVESTREAMS_CREATE = 'livestreams.create';
    case LIVESTREAMS_EDIT = 'livestreams.edit';
    case LIVESTREAMS_DELETE = 'livestreams.delete';

        // Financial Dashboard
    case FINANCIAL_DASHBOARD_VIEW = 'financial.dashboard.view';

        // Fund Categories
    case FUND_CATEGORIES_VIEW = 'fund-categories.view';
    case FUND_CATEGORIES_CREATE = 'fund-categories.create';
    case FUND_CATEGORIES_EDIT = 'fund-categories.edit';
    case FUND_CATEGORIES_DELETE = 'fund-categories.delete';

        // Donations
    case DONATIONS_VIEW = 'donations.view';
    case DONATIONS_CREATE = 'donations.create';
    case DONATIONS_EDIT = 'donations.edit';
    case DONATIONS_DELETE = 'donations.delete';

        // Expenses
    case EXPENSES_VIEW = 'expenses.view';
    case EXPENSES_CREATE = 'expenses.create';
    case EXPENSES_EDIT = 'expenses.edit';
    case EXPENSES_DELETE = 'expenses.delete';

        // Financial Reports
    case FINANCIAL_REPORTS_VIEW = 'financial-reports.view';
    case FINANCIAL_REPORTS_EXPORT = 'financial-reports.export';

        // Audit Logs
    case AUDIT_LOGS_VIEW = 'audit-logs.view';

    /**
     * Return all permission values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
