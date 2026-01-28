<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\ArticleListParams;

/**
 * Sort order.
 */
enum SortingOrder: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
