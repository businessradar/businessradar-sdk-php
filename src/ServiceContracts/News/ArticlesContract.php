<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Article;
use Businessradar\News\Articles\ArticleListParams\Sorting;
use Businessradar\News\Articles\ArticleListParams\SortingOrder;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersResponse;
use Businessradar\News\Articles\ArticleNewFeedbackResponse;
use Businessradar\News\Articles\FeedbackTypeEnum;
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
     * @param list<string> $category Category ID to filter articles
     * @param list<string> $company Company ID's
     * @param list<string> $country ISO 2-letter Country Code
     * @param bool $disableCompanyArticleDeduplication By default companies with the same trade names are grouped and the best one is picked, the other ones are not included. By disabling this the amount of company articles will grow significantly.
     * @param list<string> $dunsNumber 9-digit Dun And Bradstreet Number
     * @param list<string> $globalUltimate 9-digit Dun And Bradstreet Number
     * @param bool $includeClusteredArticles Include clustered articles
     * @param bool $isMaterial Filter articles by materiality flag (true/false)
     * @param list<string> $language ISO 2-letter Language Code
     * @param \DateTimeInterface $maxCreationDate Filter articles created before this date
     * @param \DateTimeInterface $maxPublicationDate Filter articles published before this date
     * @param \DateTimeInterface $minCreationDate Filter articles created after this date
     * @param \DateTimeInterface $minPublicationDate Filter articles published after this date
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
     * @param list<string> $portfolioID Portfolio ID to filter articles
     * @param string $query custom search filters to text search all articles
     * @param list<string> $registrationNumber Local Registration Number
     * @param string $savedArticleFilterID Filter articles on already saved article filter id
     * @param bool $sentiment Filter articles with sentiment
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
    ): ArticleNewFeedbackResponse;

    /**
     * @api
     *
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
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
