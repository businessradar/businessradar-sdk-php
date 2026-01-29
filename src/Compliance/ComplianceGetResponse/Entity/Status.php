<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse\Entity;

/**
 * * `on_hold` - On Hold
 * * `queued` - Queued
 * * `in_progress` - In Progress
 * * `completed` - Completed
 * * `skipped` - Skipped
 * * `failed` - Failed.
 */
enum Status: string
{
    case ON_HOLD = 'on_hold';

    case QUEUED = 'queued';

    case IN_PROGRESS = 'in_progress';

    case COMPLETED = 'completed';

    case SKIPPED = 'skipped';

    case FAILED = 'failed';
}
