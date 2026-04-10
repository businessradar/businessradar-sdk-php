<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Export\ArticleExport\ExportType;
use Businessradar\News\Articles\Export\ArticleExport\Filters;
use Businessradar\News\Articles\Export\ArticleExport\Status;

/**
 * Data Export Serializer.
 *
 * @phpstan-import-type FiltersShape from \Businessradar\News\Articles\Export\ArticleExport\Filters
 *
 * @phpstan-type ArticleExportShape = array{
 *   createdAt: \DateTimeInterface,
 *   exportType: ExportType|value-of<ExportType>,
 *   externalID: string,
 *   fileType: DataExportFileType|value-of<DataExportFileType>,
 *   filters: Filters|FiltersShape,
 *   location: string|null,
 *   resultCount: int|null,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class ArticleExport implements BaseModel
{
    /** @use SdkModel<ArticleExportShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * * `NEWS` - News
     * * `BINDER` - Binder
     * * `COMPANIES` - Companies
     * * `REGISTRATIONS` - Registrations
     * * `COMPLIANCE` - Compliance
     * * `BILLING` - Billing
     * * `KEY_EVENTS` - Key Events.
     *
     * @var value-of<ExportType> $exportType
     */
    #[Required('export_type', enum: ExportType::class)]
    public string $exportType;

    #[Required('external_id')]
    public string $externalID;

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
     * Location of exports.
     */
    #[Required]
    public ?string $location;

    #[Required('result_count')]
    public ?int $resultCount;

    /**
     * * `pending` - Pending
     * * `in_progress` - In Progress
     * * `failed` - Failed
     * * `finished` - Finished.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * `new ArticleExport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleExport::with(
     *   createdAt: ...,
     *   exportType: ...,
     *   externalID: ...,
     *   fileType: ...,
     *   filters: ...,
     *   location: ...,
     *   resultCount: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleExport)
     *   ->withCreatedAt(...)
     *   ->withExportType(...)
     *   ->withExternalID(...)
     *   ->withFileType(...)
     *   ->withFilters(...)
     *   ->withLocation(...)
     *   ->withResultCount(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
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
     * @param ExportType|value-of<ExportType> $exportType
     * @param DataExportFileType|value-of<DataExportFileType> $fileType
     * @param Filters|FiltersShape $filters
     * @param Status|value-of<Status> $status
     */
    public static function with(
        \DateTimeInterface $createdAt,
        ExportType|string $exportType,
        string $externalID,
        DataExportFileType|string $fileType,
        Filters|array $filters,
        ?string $location,
        ?int $resultCount,
        Status|string $status,
        \DateTimeInterface $updatedAt,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['exportType'] = $exportType;
        $self['externalID'] = $externalID;
        $self['fileType'] = $fileType;
        $self['filters'] = $filters;
        $self['location'] = $location;
        $self['resultCount'] = $resultCount;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * * `NEWS` - News
     * * `BINDER` - Binder
     * * `COMPANIES` - Companies
     * * `REGISTRATIONS` - Registrations
     * * `COMPLIANCE` - Compliance
     * * `BILLING` - Billing
     * * `KEY_EVENTS` - Key Events.
     *
     * @param ExportType|value-of<ExportType> $exportType
     */
    public function withExportType(ExportType|string $exportType): self
    {
        $self = clone $this;
        $self['exportType'] = $exportType;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

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

    /**
     * Location of exports.
     */
    public function withLocation(?string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    public function withResultCount(?int $resultCount): self
    {
        $self = clone $this;
        $self['resultCount'] = $resultCount;

        return $self;
    }

    /**
     * * `pending` - Pending
     * * `in_progress` - In Progress
     * * `failed` - Failed
     * * `finished` - Finished.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
