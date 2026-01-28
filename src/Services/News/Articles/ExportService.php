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
     * Export articles, get status using get Export details API.
     *
     * The export returns the location to an JSON-Lines file located on our S3 bucket. The
     * file is available for 7 days.
     *
     * There is a max restriction of 25.000 articles per export. No pagination supported.
     * For larger exports please contact support@businessradar.com
     *
     * @param DataExportFileType|value-of<DataExportFileType> $fileType * `PDF` - PDF
     * * `EXCEL` - Excel
     * * `JSONL` - JSONL
     * @param Filters|FiltersShape $filters article Filter Serializer
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
     * Export article details.
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
