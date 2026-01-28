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
     * @param list<string> $category Category ID to filter articles
     * @param list<string> $company Company ID's
     * @param list<string> $country ISO 2-letter Country Code
     * @param bool $disableCompanyArticleDeduplication By default companies with the same trade names are grouped and the best one is picked, the other ones are not included. By disabling this the amount of company articles will grow significantly.
     * @param list<string> $dunsNumber 9-digit Dun And Bradstreet Number
     * @param list<string> $globalUltimate 9-digit Dun And Bradstreet Number
     * @param bool $includeClusteredArticles Include clustered articles
     * @param Interval|value-of<Interval> $interval
     * @param bool $isMaterial Filter articles by materiality flag (true/false)
     * @param list<string> $language ISO 2-letter Language Code
     * @param \DateTimeInterface $maxCreationDate Filter articles created before this date
     * @param \DateTimeInterface $maxPublicationDate Filter articles published before this date
     * @param \DateTimeInterface $minCreationDate Filter articles created after this date
     * @param \DateTimeInterface $minPublicationDate Filter articles published after this date
     * @param list<string> $portfolioID Portfolio ID to filter articles
     * @param string $query custom search filters to text search all articles
     * @param list<string> $registrationNumber Local Registration Number
     * @param string $savedArticleFilterID Filter articles on already saved article filter id
     * @param bool $sentiment Filter articles with sentiment
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
