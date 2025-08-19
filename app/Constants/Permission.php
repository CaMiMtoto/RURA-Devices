<?php

namespace App\Constants;

class Permission
{
    const MANAGE_USERS = 'MANAGE_USERS';
    const MANAGE_ROLES = 'MANAGE_ROLES';
    const MANAGE_PERMISSIONS = 'MANAGE_PERMISSIONS';
    const MANAGE_DEPARTMENTS = 'MANAGE_DEPARTMENTS';
    const MANAGE_JOB_TITLES = 'MANAGE_JOB_TITLES';
    const VIEW_REPORTS = 'VIEW_REPORTS';
    const VIEW_CONFIRMED_ASSETS = 'VIEW_CONFIRMED_ASSETS';

    public static function all(): array
    {
        return [
            self::MANAGE_USERS,
            self::MANAGE_ROLES,
            self::MANAGE_PERMISSIONS,
            self::MANAGE_DEPARTMENTS,
            self::VIEW_REPORTS,
            self::MANAGE_JOB_TITLES,
            self::VIEW_CONFIRMED_ASSETS,
        ];
    }
}
