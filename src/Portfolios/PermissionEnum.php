<?php

declare(strict_types=1);

namespace Businessradar\Portfolios;

/**
 * * `view_only` - Only Viewing Access
 * * `write` - View and Write Access
 * * `admin` - View, Write and Admin Access
 * * `owner` - Portfolio Owner.
 */
enum PermissionEnum: string
{
    case VIEW_ONLY = 'view_only';

    case WRITE = 'write';

    case ADMIN = 'admin';

    case OWNER = 'owner';
}
