<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListParams;

/**
 * Filter by compliance score.
 */
enum ComplianceScore: string
{
    case HIGH = 'high';

    case LOW = 'low';

    case MEDIUM = 'medium';
}
