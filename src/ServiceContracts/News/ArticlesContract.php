<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Article;
use Businessradar\News\Articles\ArticleCreateFeedbackParams\FeedbackType;
use Businessradar\News\Articles\ArticleListParams\Sorting;
use Businessradar\News\Articles\ArticleListParams\SortingOrder;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersResponse;
use Businessradar\News\Articles\ArticleNewFeedbackResponse;
use Businessradar\NextKey;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ArticlesContract
{
    /**
     * @api
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
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
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
    ): NextKey;

    /**
     * @api
     *
     * @param FeedbackType|value-of<FeedbackType> $feedbackType * `false_positive` - False Positive
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
        FeedbackType|string|null $feedbackType = null,
        RequestOptions|array|null $requestOptions = null,
    ): ArticleNewFeedbackResponse;

    /**
     * @api
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<ArticleListSavedArticleFiltersResponse>
     *
     * @throws APIException
     */
    public function listSavedArticleFilters(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey;

    /**
     * @api
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
    ): array;
}
