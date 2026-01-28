<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse;

enum AdverseMediaScore: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';

    case EMPTY = '';
}
