<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsParams;

/**
 * Sorting order.
 */
enum Order: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
