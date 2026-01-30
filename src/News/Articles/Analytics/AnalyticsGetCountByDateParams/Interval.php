<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams;

/**
 * The time interval for aggregation.
 */
enum Interval: string
{
    case DAY = 'day';

    case MONTH = 'month';

    case WEEK = 'week';

    case YEAR = 'year';
}
