<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve\Director;

/**
 * * `BOARD` - Board
 * * `MANAGEMENT` - Management
 * * `OFFICER` - Officer / Signatory
 * * `OTHER` - Other.
 */
enum RoleGroup: string
{
    case BOARD = 'BOARD';

    case MANAGEMENT = 'MANAGEMENT';

    case OFFICER = 'OFFICER';

    case OTHER = 'OTHER';
}
