<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve\Director;

enum Gender: string
{
    case M = 'M';

    case F = 'F';

    case EMPTY = '';
}
