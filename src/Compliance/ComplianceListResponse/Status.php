<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResponse;

/**
 * * `pending` - Pending
 * * `queued` - Queued
 * * `in_progress` - In Progress
 * * `searching_directors` - Searching Directors
 * * `completed` - Completed
 * * `failed` - Failed.
 */
enum Status: string
{
    case PENDING = 'pending';

    case QUEUED = 'queued';

    case IN_PROGRESS = 'in_progress';

    case SEARCHING_DIRECTORS = 'searching_directors';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
