<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News\Articles;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams\Interval;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateResponseItem;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface AnalyticsContract
{
    /**
     * @api
     *
     * @param list<string> $category filter by one or more article Category IDs (UUIDs)
     * @param list<string> $company filter by internal Company UUIDs
     * @param list<string> $country Filter by ISO 2-letter Country Codes (e.g., 'US', 'GB').
     * @param bool $disableCompanyArticleDeduplication By default, companies with the same trade names are grouped and the best match is selected. Enable this to see all associated companies.
     * @param list<string> $dunsNumber filter by one or more 9-digit Dun & Bradstreet Numbers
     * @param list<string> $globalUltimate filter by Global Ultimate DUNS Numbers
     * @param bool $includeClusteredArticles include articles that are part of a cluster (reprints or similar articles)
     * @param Interval|value-of<Interval> $interval the time interval for aggregation
     * @param bool $isMaterial filter by materiality flag (relevance to business risk)
     * @param list<string> $language Filter by ISO 2-letter Language Codes (e.g., 'en', 'nl').
     * @param \DateTimeInterface $maxCreationDate filter articles added to our database at or before this date/time
     * @param \DateTimeInterface $maxPublicationDate filter articles published at or before this date/time
     * @param \DateTimeInterface $minCreationDate filter articles added to our database at or after this date/time
     * @param \DateTimeInterface $minPublicationDate filter articles published at or after this date/time
     * @param list<string> $portfolioID filter articles related to companies in specific Portfolios (UUIDs)
     * @param string $query full-text search query for filtering articles by content
     * @param list<string> $registrationNumber filter by local company registration numbers
     * @param string $savedArticleFilterID apply a previously saved set of article filters (UUID)
     * @param bool $sentiment filter by sentiment: `true` for positive, `false` for negative
     * @param RequestOpts|null $requestOptions
     *
     * @return list<AnalyticsGetCountByDateResponseItem>
     *
     * @throws APIException
     */
    public function getCountByDate(
        ?array $category = null,
        ?array $company = null,
        ?array $country = null,
        bool $disableCompanyArticleDeduplication = false,
        ?array $dunsNumber = null,
        ?array $globalUltimate = null,
        bool $includeClusteredArticles = false,
        Interval|string $interval = 'day',
        ?bool $isMaterial = null,
        ?array $language = null,
        ?\DateTimeInterface $maxCreationDate = null,
        ?\DateTimeInterface $maxPublicationDate = null,
        ?\DateTimeInterface $minCreationDate = null,
        ?\DateTimeInterface $minPublicationDate = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $savedArticleFilterID = null,
        ?bool $sentiment = null,
        RequestOptions|array|null $requestOptions = null,
    ): array;
}
