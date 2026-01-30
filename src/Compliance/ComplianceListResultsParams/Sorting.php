<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsParams;

/**
 * Sorting field.
 */
enum Sorting: string
{
    case CONFIDENCE = 'confidence';

    case CREATED_AT = 'created_at';

    case SOURCE_DATE = 'source_date';
}
