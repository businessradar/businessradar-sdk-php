<?php

declare(strict_types=1);

namespace Businessradar\Portfolios\PortfolioCreateParams;

/**
 * Default permission for all users in organization.
 *
 * * `view_only` - Only Viewing Access
 * * `write` - View and Write Access
 * * `admin` - View, Write and Admin Access
 * * `owner` - Portfolio Owner
 */
enum DefaultPermission: string
{
    case VIEW_ONLY = 'view_only';

    case WRITE = 'write';

    case ADMIN = 'admin';

    case OWNER = 'owner';

    case EMPTY = '';
}
