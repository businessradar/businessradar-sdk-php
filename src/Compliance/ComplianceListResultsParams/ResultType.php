<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsParams;

/**
 * Filter by result type.
 */
enum ResultType: string
{
    case ADVERSE_MEDIA = 'adverse_media';

    case ENFORCEMENT = 'enforcement';

    case GOVT_OWNED = 'govt_owned';

    case PEP = 'pep';

    case SANCTION = 'sanction';
}
