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

        // Notifications
    case NOTIFICATIONS_VIEW = 'notifications.view';
    case NOTIFICATIONS_CREATE = 'notifications.create';
    case NOTIFICATIONS_EDIT = 'notifications.edit';
    case NOTIFICATIONS_DELETE = 'notifications.delete';

        // Media Categories
    case MEDIA_CATEGORIES_VIEW = 'media-categories.view';
    case MEDIA_CATEGORIES_CREATE = 'media-categories.create';
    case MEDIA_CATEGORIES_EDIT = 'media-categories.edit';
    case MEDIA_CATEGORIES_DELETE = 'media-categories.delete';

        // Media Albums
    case MEDIA_ALBUMS_VIEW = 'media-albums.view';
    case MEDIA_ALBUMS_CREATE = 'media-albums.create';
    case MEDIA_ALBUMS_EDIT = 'media-albums.edit';
    case MEDIA_ALBUMS_DELETE = 'media-albums.delete';

        // Media Items
    case MEDIA_ITEMS_VIEW = 'media-items.view';
    case MEDIA_ITEMS_CREATE = 'media-items.create';
    case MEDIA_ITEMS_EDIT = 'media-items.edit';
    case MEDIA_ITEMS_DELETE = 'media-items.delete';
    case MEDIA_ITEMS_DOWNLOAD = 'media-items.download';

        // Media Teams
    case MEDIA_TEAMS_VIEW = 'media-teams.view';
    case MEDIA_TEAMS_CREATE = 'media-teams.create';
    case MEDIA_TEAMS_EDIT = 'media-teams.edit';
    case MEDIA_TEAMS_DELETE = 'media-teams.delete';

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

        // Events
    case EVENTS_VIEW = 'events.view';
    case EVENTS_CREATE = 'events.create';
    case EVENTS_EDIT = 'events.edit';
    case EVENTS_DELETE = 'events.delete';

        // Galleries
    case GALLERIES_VIEW = 'galleries.view';
    case GALLERIES_CREATE = 'galleries.create';
    case GALLERIES_EDIT = 'galleries.edit';
    case GALLERIES_DELETE = 'galleries.delete';

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

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
