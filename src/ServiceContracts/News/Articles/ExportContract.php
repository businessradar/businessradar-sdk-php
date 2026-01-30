<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News\Articles;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Export\ArticleExport;
use Businessradar\News\Articles\Export\DataExportFileType;
use Businessradar\News\Articles\Export\ExportCreateParams\Filters;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type FiltersShape from \Businessradar\News\Articles\Export\ExportCreateParams\Filters
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ExportContract
{
    /**
     * @api
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
    ): ArticleExport;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): ArticleExport;
}
