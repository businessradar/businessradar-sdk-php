<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceCreateParams;

/**
 * * `BOARD` - Board
 * * `MANAGEMENT` - Management
 * * `OFFICER` - Officer / Signatory
 * * `OTHER` - Other.
 */
enum DirectorRoleGroup: string
{
    case BOARD = 'BOARD';

    case MANAGEMENT = 'MANAGEMENT';

    case OFFICER = 'OFFICER';

    case OTHER = 'OTHER';
}
