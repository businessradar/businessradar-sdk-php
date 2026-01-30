<?php

declare(strict_types=1);

namespace Businessradar\Services\News\Articles;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Conversion\ListOf;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams\Interval;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateResponseItem;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\News\Articles\AnalyticsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class AnalyticsRawService implements AnalyticsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * ### Get Article Aggregations
     *
     * Retrieve the number of articles and their average sentiment, grouped by date.
     *
     * @param array{
     *   category?: list<string>,
     *   company?: list<string>,
     *   country?: list<string>,
     *   disableCompanyArticleDeduplication?: bool,
     *   dunsNumber?: list<string>,
     *   globalUltimate?: list<string>,
     *   includeClusteredArticles?: bool,
     *   interval?: Interval|value-of<Interval>,
     *   isMaterial?: bool,
     *   language?: list<string>,
     *   maxCreationDate?: \DateTimeInterface,
     *   maxPublicationDate?: \DateTimeInterface,
     *   minCreationDate?: \DateTimeInterface,
     *   minPublicationDate?: \DateTimeInterface,
     *   portfolioID?: list<string>,
     *   query?: string,
     *   registrationNumber?: list<string>,
     *   savedArticleFilterID?: string,
     *   sentiment?: bool,
     * }|AnalyticsGetCountByDateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<AnalyticsGetCountByDateResponseItem>>
     *
     * @throws APIException
     */
    public function getCountByDate(
        array|AnalyticsGetCountByDateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AnalyticsGetCountByDateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/articles/analytics/dates/',
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
                    'portfolioID' => 'portfolio_id',
                    'registrationNumber' => 'registration_number',
                    'savedArticleFilterID' => 'saved_article_filter_id',
                ],
            ),
            options: $options,
            convert: new ListOf(AnalyticsGetCountByDateResponseItem::class),
        );
    }
}
