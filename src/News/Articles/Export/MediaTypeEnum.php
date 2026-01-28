<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

/**
 * * `GAZETTE` - GAZETTE
 * * `MAINSTREAM` - MAINSTREAM.
 */
enum MediaTypeEnum: string
{
    case GAZETTE = 'GAZETTE';

    case MAINSTREAM = 'MAINSTREAM';
}
