<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsParams;

/**
 * Filter adverse media results by sub-source (news / icij / enforcement).
 */
enum SourceType: string
{
    case ENFORCEMENT = 'enforcement';

    case ICIJ = 'icij';

    case NEWS = 'news';
}
