<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

/**
 * * `low` - Low
 * * `medium` - Medium
 * * `high` - High.
 */
enum ComplianceCheckScoreEnum: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';
}
