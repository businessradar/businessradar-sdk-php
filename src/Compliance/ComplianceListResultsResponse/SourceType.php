<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

/**
 * * `news` - News
 * * `icij` - ICIJ
 * * `enforcement` - Enforcement.
 */
enum SourceType: string
{
    case NEWS = 'news';

    case ICIJ = 'icij';

    case ENFORCEMENT = 'enforcement';
}
