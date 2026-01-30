<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse\Entity;

enum Gender: string
{
    case MALE = 'male';

    case FEMALE = 'female';

    case EMPTY = '';
}
