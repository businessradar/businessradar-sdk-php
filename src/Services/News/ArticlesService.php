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
     * Search News Articles.
     *
     * List Articles from the Business Radar platform, search using advanced queries or
     * check articles that have been published since last check.
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
     * Create Article Feedback.
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
     * List Create Saved Article Filter.
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
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listSavedArticleFilters(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve Article Embedding Search.
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
