<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListParams;

/**
 * Sorting field.
 */
enum Sorting: string
{
    case CREATED_AT = 'created_at';

    case FINISHED_AT = 'finished_at';

    case RESULTS_CHANGED_AT = 'results_changed_at';
}
