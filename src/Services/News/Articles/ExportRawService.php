<?php

declare(strict_types=1);

namespace Businessradar\Services\News\Articles;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Export\ArticleExport;
use Businessradar\News\Articles\Export\DataExportFileType;
use Businessradar\News\Articles\Export\ExportCreateParams;
use Businessradar\News\Articles\Export\ExportCreateParams\Filters;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\News\Articles\ExportRawContract;

/**
 * @phpstan-import-type FiltersShape from \Businessradar\News\Articles\Export\ExportCreateParams\Filters
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ExportRawService implements ExportRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * ### Export Articles (Asynchronous)
     *
     * Request an asynchronous export of articles matching specific filters. Once
     * requested, Business Radar processes the export in the background.
     *
     * To check the status and retrieve the download link, you can use the [GET
     * /articles/export/{external_id}](/ext/v3/#/ext/ext_v3_articles_export_retrieve)
     * endpoint.
     *
     * The export process returns a reference to a JSON-Lines file stored on S3, which
     * remains available for 7 days.
     *
     * *Limit: 25,000 articles per export.*
     *
     * @param array{
     *   fileType: DataExportFileType|value-of<DataExportFileType>,
     *   filters: Filters|FiltersShape,
     * }|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleExport>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExportCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/articles/export/',
            body: (object) $parsed,
            options: $options,
            convert: ArticleExport::class,
        );
    }

    /**
     * @api
     *
     * ### Export Status & Details
     *
     * Check the status of an ongoing export or retrieve the download link for a completed
     * export.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleExport>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/articles/export/%1$s', $externalID],
            options: $requestOptions,
            convert: ArticleExport::class,
        );
    }
}
