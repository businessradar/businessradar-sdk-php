<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Export\ExportCreateParams\Filters;

/**
 * Export articles, get status using get Export details API.
 *
 * The export returns the location to an JSON-Lines file located on our S3 bucket. The
 * file is available for 7 days.
 *
 * There is a max restriction of 25.000 articles per export. No pagination supported.
 * For larger exports please contact support@businessradar.com
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
     * Article Filter Serializer.
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
     * Article Filter Serializer.
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
