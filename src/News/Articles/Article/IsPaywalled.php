<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Article;

enum IsPaywalled: string
{
    case FULL = 'full';

    case PARTIAL = 'partial';

    case EMPTY = '';
}
