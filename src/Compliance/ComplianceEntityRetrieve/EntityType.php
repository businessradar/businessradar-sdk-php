<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve;

/**
 * * `individual` - Individual
 * * `company` - Company.
 */
enum EntityType: string
{
    case INDIVIDUAL = 'individual';

    case COMPANY = 'company';
}
