<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Export\ExportCreateParams\Filters;

/**
 * ### Export Articles (Asynchronous).
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
 * @see Businessradar\Services\News\Articles\ExportService::create()
 *
 * @phpstan-import-type FiltersShape from \Businessradar\News\Articles\Export\ExportCreateParams\Filters
 *
 * @phpstan-type ExportCreateParamsShape = array{
 *   fileType: DataExportFileType|value-of<DataExportFileType>,
 *   filters: Filters|FiltersShape,
 * }
 */
final class ExportCreateParams implements BaseModel
{
    /** @use SdkModel<ExportCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * * `PDF` - PDF
     * * `EXCEL` - Excel
     * * `JSONL` - JSONL.
     *
     * @var value-of<DataExportFileType> $fileType
     */
    #[Required('file_type', enum: DataExportFileType::class)]
    public string $fileType;

    /**
     * ### Article Filters.
     *
     * Used to validate and process filters for article searches. Supports filtering by
     * query text, countries, languages, specific companies (DUNS), and portfolios.
     */
    #[Required]
    public Filters $filters;

    /**
     * `new ExportCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportCreateParams::with(fileType: ..., filters: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportCreateParams)->withFileType(...)->withFilters(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DataExportFileType|value-of<DataExportFileType> $fileType
     * @param Filters|FiltersShape $filters
     */
    public static function with(
        DataExportFileType|string $fileType,
        Filters|array $filters
    ): self {
        $self = new self;

        $self['fileType'] = $fileType;
        $self['filters'] = $filters;

        return $self;
    }

    /**
     * * `PDF` - PDF
     * * `EXCEL` - Excel
     * * `JSONL` - JSONL.
     *
     * @param DataExportFileType|value-of<DataExportFileType> $fileType
     */
    public function withFileType(DataExportFileType|string $fileType): self
    {
        $self = clone $this;
        $self['fileType'] = $fileType;

        return $self;
    }

    /**
     * ### Article Filters.
     *
     * Used to validate and process filters for article searches. Supports filtering by
     * query text, countries, languages, specific companies (DUNS), and portfolios.
     *
     * @param Filters|FiltersShape $filters
     */
    public function withFilters(Filters|array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }
}
