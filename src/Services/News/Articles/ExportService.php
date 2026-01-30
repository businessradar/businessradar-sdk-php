<?php

declare(strict_types=1);

namespace Businessradar\Services\News\Articles;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\News\Articles\Export\ArticleExport;
use Businessradar\News\Articles\Export\DataExportFileType;
use Businessradar\News\Articles\Export\ExportCreateParams\Filters;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\News\Articles\ExportContract;

/**
 * @phpstan-import-type FiltersShape from \Businessradar\News\Articles\Export\ExportCreateParams\Filters
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ExportService implements ExportContract
{
    /**
     * @api
     */
    public ExportRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ExportRawService($client);
    }

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
     * @param DataExportFileType|value-of<DataExportFileType> $fileType * `PDF` - PDF
     * * `EXCEL` - Excel
     * * `JSONL` - JSONL
     * @param Filters|FiltersShape $filters ### Article Filters
     *
     * Used to validate and process filters for article searches. Supports filtering by
     * query text, countries, languages, specific companies (DUNS), and portfolios.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        DataExportFileType|string $fileType,
        Filters|array $filters,
        RequestOptions|array|null $requestOptions = null,
    ): ArticleExport {
        $params = Util::removeNulls(
            ['fileType' => $fileType, 'filters' => $filters]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): ArticleExport {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($externalID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
