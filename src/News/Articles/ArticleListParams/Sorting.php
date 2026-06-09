<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\ArticleListParams;

/**
 * Sort articles. Use 'priority' to sort primarily by category priority (publication date as tiebreaker), surfacing the most important articles across the whole result set regardless of date. Lower numeric priority values indicate higher priority, so use sorting_order=asc for best-first ordering.
 */
enum Sorting: string
{
    case CREATION_DATE = 'creation_date';

    case PRIORITY = 'priority';

    case PUBLICATION_DATE_CLUSTERING = 'publication_date_clustering';

    case PUBLICATION_DATE_PRIORITY = 'publication_date_priority';

    case PUBLICATION_DATE_SOURCE_REFERENCES = 'publication_date_source_references';

    case PUBLICATION_DATETIME = 'publication_datetime';
}
