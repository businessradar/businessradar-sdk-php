<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve;

/**
 * * `individual` - Individual
 * * `company` - Company
 * * `vessel` - Vessel.
 */
enum EntityType: string
{
    case INDIVIDUAL = 'individual';

    case COMPANY = 'company';

    case VESSEL = 'vessel';
}
