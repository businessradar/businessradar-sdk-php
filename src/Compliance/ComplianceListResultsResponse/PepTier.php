<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

/**
 * PEP tier of this match (national / regional / local / international).
 *
 * * `TIER_1` - Tier 1 (national)
 * * `TIER_2` - Tier 2 (regional)
 * * `TIER_3` - Tier 3 (local / SOE)
 * * `INTERNATIONAL_ORG` - International organization
 */
enum PepTier: string
{
    case TIER_1 = 'TIER_1';

    case TIER_2 = 'TIER_2';

    case TIER_3 = 'TIER_3';

    case INTERNATIONAL_ORG = 'INTERNATIONAL_ORG';

    case EMPTY = '';
}
