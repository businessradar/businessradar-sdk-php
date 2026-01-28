<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse\Entity;

/**
 * * `ubo` - Ultimate Beneficial Owner
 * * `director` - Director
 * * `company` - Company
 * * `manually_added` - Manually added.
 */
enum EntityRole: string
{
    case UBO = 'ubo';

    case DIRECTOR = 'director';

    case COMPANY = 'company';

    case MANUALLY_ADDED = 'manually_added';
}
