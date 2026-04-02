<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListParams;

/**
 * Filter by compliance check status.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case IN_PROGRESS = 'in_progress';

    case PENDING = 'pending';

    case QUEUED = 'queued';

    case SEARCHING_DIRECTORS = 'searching_directors';
}
