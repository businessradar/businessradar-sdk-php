<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams;

enum Interval: string
{
    case DAY = 'day';

    case MONTH = 'month';

    case WEEK = 'week';

    case YEAR = 'year';
}
