<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Article;
use Businessradar\News\Articles\ArticleCreateFeedbackParams;
use Businessradar\News\Articles\ArticleListParams;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersParams;
use Businessradar\News\Articles\ArticleListSavedArticleFiltersResponse;
use Businessradar\News\Articles\ArticleNewFeedbackResponse;
use Businessradar\NextKey;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ArticlesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ArticleListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Article>>
     *
     * @throws APIException
     */
    public function list(
        array|ArticleListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ArticleCreateFeedbackParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleNewFeedbackResponse>
     *
     * @throws APIException
     */
    public function createFeedback(
        array|ArticleCreateFeedbackParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ArticleListSavedArticleFiltersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<ArticleListSavedArticleFiltersResponse>>
     *
     * @throws APIException
     */
    public function listSavedArticleFilters(
        array|ArticleListSavedArticleFiltersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
