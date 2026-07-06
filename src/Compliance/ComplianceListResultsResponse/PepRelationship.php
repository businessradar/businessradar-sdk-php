<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

/**
 * How this person relates to the PEP status: self, family or associate.
 *
 * * `SELF` - Self
 * * `FAMILY` - Family member
 * * `ASSOCIATE` - Close associate
 */
enum PepRelationship: string
{
    case SELF = 'SELF';

    case FAMILY = 'FAMILY';

    case ASSOCIATE = 'ASSOCIATE';

    case EMPTY = '';
}
