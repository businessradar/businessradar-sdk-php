<?php

declare(strict_types=1);

namespace Businessradar\Services\News;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Conversion\ListOf;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\News\Articles\Article;
use Businessradar\News\Articles\ArticleCreateFeedbackParams;
use Businessradar\News\Articles\ArticleGetRelatedResponseItem;
use Businessradar\News\Articles\ArticleListParams;
use Businessradar\News\Articles\ArticleListParams\Sorting;
use Businessradar\News\Articles\ArticleListParams\SortingOrder;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersParams;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersResponse;
use Businessradar\News\Articles\ArticleNewFeedbackResponse;
use Businessradar\News\Articles\FeedbackTypeEnum;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\News\ArticlesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ArticlesRawService implements ArticlesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * ### Search News Articles
     *
     * Retrieve articles matching the specified search criteria. Advanced queries and
     * incremental checks (using publication/creation dates) are supported.
     *
     * @param array{
     *   category?: list<string>,
     *   company?: list<string>,
     *   country?: list<string>,
     *   disableCompanyArticleDeduplication?: bool,
     *   dunsNumber?: list<string>,
     *   globalUltimate?: list<string>,
     *   includeClusteredArticles?: bool,
     *   isMaterial?: bool,
     *   language?: list<string>,
     *   maxCreationDate?: \DateTimeInterface,
     *   maxPublicationDate?: \DateTimeInterface,
     *   minCreationDate?: \DateTimeInterface,
     *   minPublicationDate?: \DateTimeInterface,
     *   nextKey?: string,
     *   portfolioID?: list<string>,
     *   query?: string,
     *   registrationNumber?: list<string>,
     *   savedArticleFilterID?: string,
     *   sentiment?: bool,
     *   sorting?: value-of<Sorting>,
     *   sortingOrder?: SortingOrder|value-of<SortingOrder>,
     * }|ArticleListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Article>>
     *
     * @throws APIException
     */
    public function list(
        array|ArticleListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArticleListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/articles',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'disableCompanyArticleDeduplication' => 'disable_company_article_deduplication',
                    'dunsNumber' => 'duns_number',
                    'globalUltimate' => 'global_ultimate',
                    'includeClusteredArticles' => 'include_clustered_articles',
                    'isMaterial' => 'is_material',
                    'maxCreationDate' => 'max_creation_date',
                    'maxPublicationDate' => 'max_publication_date',
                    'minCreationDate' => 'min_creation_date',
                    'minPublicationDate' => 'min_publication_date',
                    'nextKey' => 'next_key',
                    'portfolioID' => 'portfolio_id',
                    'registrationNumber' => 'registration_number',
                    'savedArticleFilterID' => 'saved_article_filter_id',
                    'sortingOrder' => 'sorting_order',
                ],
            ),
            options: $options,
            convert: Article::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### Submit Article Feedback
     *
     * Submit feedback for a specific article. This helps improve our analysis and
     * relevance.
     *
     * @param array{
     *   article: string,
     *   comment?: string|null,
     *   email?: string|null,
     *   feedbackType?: FeedbackTypeEnum|value-of<FeedbackTypeEnum>,
     * }|ArticleCreateFeedbackParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleNewFeedbackResponse>
     *
     * @throws APIException
     */
    public function createFeedback(
        array|ArticleCreateFeedbackParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArticleCreateFeedbackParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/articles/feedback/',
            body: (object) $parsed,
            options: $options,
            convert: ArticleNewFeedbackResponse::class,
        );
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
     * @param array{nextKey?: string}|ArticleListSavedArticleFiltersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<ArticleListSavedArticleFiltersResponse>>
     *
     * @throws APIException
     */
    public function listSavedArticleFilters(
        array|ArticleListSavedArticleFiltersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ArticleListSavedArticleFiltersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/saved_article_filters',
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: ArticleListSavedArticleFiltersResponse::class,
            page: NextKey::class,
        );
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
     * @return BaseResponse<list<mixed>>
     *
     * @throws APIException
     */
    public function retrieveRelated(
        string $articleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/articles/%1$s/related/', $articleID],
            options: $requestOptions,
            convert: new ListOf(ArticleGetRelatedResponseItem::class),
        );
    }
}
