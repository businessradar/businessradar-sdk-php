<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\ArticleListParams;

/**
 * Sort articles.
 */
enum Sorting: string
{
    case CREATION_DATE = 'creation_date';

    case PUBLICATION_DATE_CLUSTERING = 'publication_date_clustering';

    case PUBLICATION_DATE_PRIORITY = 'publication_date_priority';

    case PUBLICATION_DATE_SOURCE_REFERENCES = 'publication_date_source_references';

    case PUBLICATION_DATETIME = 'publication_datetime';
}
