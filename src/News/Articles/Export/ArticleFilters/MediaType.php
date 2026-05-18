<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export\ArticleFilters;

enum MediaType: string
{
    case GAZETTE = 'GAZETTE';

    case MAINSTREAM = 'MAINSTREAM';
}
