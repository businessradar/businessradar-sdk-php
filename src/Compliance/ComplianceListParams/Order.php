<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListParams;

/**
 * Sorting order.
 */
enum Order: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
