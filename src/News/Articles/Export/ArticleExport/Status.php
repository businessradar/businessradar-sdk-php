<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export\ArticleExport;

/**
 * * `pending` - Pending
 * * `in_progress` - In Progress
 * * `failed` - Failed
 * * `finished` - Finished.
 */
enum Status: string
{
    case PENDING = 'pending';

    case IN_PROGRESS = 'in_progress';

    case FAILED = 'failed';

    case FINISHED = 'finished';
}
