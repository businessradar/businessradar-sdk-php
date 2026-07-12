<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

/**
 * Nature of this match's government relationship (ownership level or control without ownership).
 *
 * * `WHOLLY_OWNED` - Wholly state-owned
 * * `MAJORITY_OWNED` - Majority state-owned
 * * `MINORITY_OWNED` - Minority state-owned
 * * `STATE_CONTROLLED` - State-controlled
 * * `GOVERNMENT_LINKED` - Government-linked
 */
enum SoeRelationshipType: string
{
    case WHOLLY_OWNED = 'WHOLLY_OWNED';

    case MAJORITY_OWNED = 'MAJORITY_OWNED';

    case MINORITY_OWNED = 'MINORITY_OWNED';

    case STATE_CONTROLLED = 'STATE_CONTROLLED';

    case GOVERNMENT_LINKED = 'GOVERNMENT_LINKED';

    case EMPTY = '';
}
