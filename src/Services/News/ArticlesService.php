<?php

declare(strict_types=1);

namespace Businessradar\Services\News;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\News\Articles\Article;
use Businessradar\News\Articles\ArticleListParams\Sorting;
use Businessradar\News\Articles\ArticleListParams\SortingOrder;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersResponse;
use Businessradar\News\Articles\ArticleNewFeedbackResponse;
use Businessradar\News\Articles\FeedbackTypeEnum;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\News\ArticlesContract;
use Businessradar\Services\News\Articles\AnalyticsService;
use Businessradar\Services\News\Articles\ExportService;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ArticlesService implements ArticlesContract
{
    /**
     * @api
     */
    public ArticlesRawService $raw;

    /**
     * @api
     */
    public AnalyticsService $analytics;

    /**
     * @api
     */
    public ExportService $export;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ArticlesRawService($client);
        $this->analytics = new AnalyticsService($client);
        $this->export = new ExportService($client);
    }

    /**
     * @api
     *
     * ### Search News Articles
     *
     * Retrieve articles matching the specified search criteria. Advanced queries and
     * incremental checks (using publication/creation dates) are supported.
     *
     * @param list<string> $category filter by article Category IDs (UUIDs)
     * @param list<string> $company filter by internal Company UUIDs
     * @param list<string> $country Filter by ISO 2-letter Country Codes (e.g., 'US', 'GB').
     * @param bool $disableCompanyArticleDeduplication By default, companies with the same trade names are grouped and the best match is selected. Enable this to see all associated companies.
     * @param list<string> $dunsNumber filter by one or more 9-digit Dun & Bradstreet Numbers
     * @param list<string> $globalUltimate filter by Global Ultimate DUNS Numbers
     * @param bool $includeClusteredArticles include articles that are part of a cluster (reprints or similar articles)
     * @param bool $isMaterial filter by materiality flag (relevance to business risk)
     * @param list<string> $language Filter by ISO 2-letter Language Codes (e.g., 'en', 'nl').
     * @param \DateTimeInterface $maxCreationDate filter articles added to our database at or before this date/time
     * @param \DateTimeInterface $maxPublicationDate filter articles published at or before this date/time
     * @param \DateTimeInterface $minCreationDate filter articles added to our database at or after this date/time
     * @param \DateTimeInterface $minPublicationDate filter articles published at or after this date/time
     * @param string $nextKey An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
     * @param list<string> $portfolioID filter articles related to companies in specific Portfolios (UUIDs)
     * @param string $query full-text search query for filtering articles by content
     * @param list<string> $registrationNumber filter by local company registration numbers
     * @param string $savedArticleFilterID apply a previously saved set of article filters (UUID)
     * @param bool $sentiment filter by sentiment: `true` for positive, `false` for negative
     * @param Sorting|value-of<Sorting> $sorting Sort articles
     * @param SortingOrder|value-of<SortingOrder> $sortingOrder Sort order
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<Article>
     *
     * @throws APIException
     */
    public function list(
        ?array $category = null,
        ?array $company = null,
        ?array $country = null,
        bool $disableCompanyArticleDeduplication = false,
        ?array $dunsNumber = null,
        ?array $globalUltimate = null,
        bool $includeClusteredArticles = false,
        ?bool $isMaterial = null,
        ?array $language = null,
        ?\DateTimeInterface $maxCreationDate = null,
        ?\DateTimeInterface $maxPublicationDate = null,
        ?\DateTimeInterface $minCreationDate = null,
        ?\DateTimeInterface $minPublicationDate = null,
        ?string $nextKey = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $savedArticleFilterID = null,
        ?bool $sentiment = null,
        Sorting|string $sorting = 'publication_datetime',
        SortingOrder|string $sortingOrder = 'desc',
        RequestOptions|array|null $requestOptions = null,
    ): NextKey {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'company' => $company,
                'country' => $country,
                'disableCompanyArticleDeduplication' => $disableCompanyArticleDeduplication,
                'dunsNumber' => $dunsNumber,
                'globalUltimate' => $globalUltimate,
                'includeClusteredArticles' => $includeClusteredArticles,
                'isMaterial' => $isMaterial,
                'language' => $language,
                'maxCreationDate' => $maxCreationDate,
                'maxPublicationDate' => $maxPublicationDate,
                'minCreationDate' => $minCreationDate,
                'minPublicationDate' => $minPublicationDate,
                'nextKey' => $nextKey,
                'portfolioID' => $portfolioID,
                'query' => $query,
                'registrationNumber' => $registrationNumber,
                'savedArticleFilterID' => $savedArticleFilterID,
                'sentiment' => $sentiment,
                'sorting' => $sorting,
                'sortingOrder' => $sortingOrder,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Submit Article Feedback
     *
     * Submit feedback for a specific article. This helps improve our analysis and
     * relevance.
     *
     * @param FeedbackTypeEnum|value-of<FeedbackTypeEnum> $feedbackType * `false_positive` - False Positive
     * * `no_risk` - No Risk
     * * `risk_confirmed` - Risk Confirmed
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFeedback(
        string $article,
        ?string $comment = null,
        ?string $email = null,
        FeedbackTypeEnum|string|null $feedbackType = null,
        RequestOptions|array|null $requestOptions = null,
    ): ArticleNewFeedbackResponse {
        $params = Util::removeNulls(
            [
                'article' => $article,
                'comment' => $comment,
                'email' => $email,
                'feedbackType' => $feedbackType,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFeedback(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Saved Article Filters
     *
     * Retrieve a list of all search filters saved by the current profile. These filters
     * can be applied to article search requests using the `saved_article_filter_id`
     * parameter.
     *
     * @param string $nextKey An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<ArticleListSavedArticleFiltersResponse>
     *
     * @throws APIException
     */
    public function listSavedArticleFilters(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listSavedArticleFilters(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Find Related Articles
     *
     * Retrieve a list of articles that are semantically similar to the specified article,
     * ranked by similarity distance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<mixed>
     *
     * @throws APIException
     */
    public function retrieveRelated(
        string $articleID,
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveRelated($articleID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
