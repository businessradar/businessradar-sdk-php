<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Compliance\ComplianceListParams\ComplianceScore;
use Businessradar\Compliance\ComplianceListParams\Order;
use Businessradar\Compliance\ComplianceListParams\Sorting;
use Businessradar\Compliance\ComplianceListParams\Status;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Compliance Checks.
 *
 * **GET** — Retrieve a paginated list of compliance checks created via this API key.
 * Supports filtering by status and date ranges, and sorting by key timestamps.
 *
 * **POST** — Initiate a new compliance screening using one of two methods:
 *
 * 1. **Company-based screening**: Provide a `company_id` to screen the company.
 * Optionally enable screening of related entities (UBOs and directors) via
 * `ubo_screening_enabled` and `directors_screening_enabled`. You can also include
 * additional custom `entities` to be screened alongside the company.
 *
 * 2. **Custom entity screening**: Provide a list of `entities` without a `company_id`
 * to screen specific individuals or organizations that are not necessarily affiliated
 * with a company in our database.
 *
 * @see Businessradar\Services\ComplianceService::list()
 *
 * @phpstan-type ComplianceListParamsShape = array{
 *   adverseMediaMonitoringEnabled?: bool|null,
 *   complianceScore?: null|ComplianceScore|value-of<ComplianceScore>,
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   nextKey?: string|null,
 *   order?: null|Order|value-of<Order>,
 *   resultsChangedAtGte?: \DateTimeInterface|null,
 *   resultsChangedAtLte?: \DateTimeInterface|null,
 *   sanctionMonitoringEnabled?: bool|null,
 *   sorting?: null|Sorting|value-of<Sorting>,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ComplianceListParams implements BaseModel
{
    /** @use SdkModel<ComplianceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter checks that have entities with adverse media monitoring enabled (pending or active).
     */
    #[Optional]
    public ?bool $adverseMediaMonitoringEnabled;

    /**
     * Filter by compliance score.
     *
     * @var value-of<ComplianceScore>|null $complianceScore
     */
    #[Optional(enum: ComplianceScore::class)]
    public ?string $complianceScore;

    /**
     * Filter checks created at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Filter checks created at or before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Sorting order.
     *
     * @var value-of<Order>|null $order
     */
    #[Optional(enum: Order::class)]
    public ?string $order;

    /**
     * Filter checks with results changed at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $resultsChangedAtGte;

    /**
     * Filter checks with results changed at or before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $resultsChangedAtLte;

    /**
     * Filter checks that have entities with sanction monitoring enabled (pending or active).
     */
    #[Optional]
    public ?bool $sanctionMonitoringEnabled;

    /**
     * Sorting field.
     *
     * @var value-of<Sorting>|null $sorting
     */
    #[Optional(enum: Sorting::class)]
    public ?string $sorting;

    /**
     * Filter by compliance check status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ComplianceScore|value-of<ComplianceScore>|null $complianceScore
     * @param Order|value-of<Order>|null $order
     * @param Sorting|value-of<Sorting>|null $sorting
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?bool $adverseMediaMonitoringEnabled = null,
        ComplianceScore|string|null $complianceScore = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $nextKey = null,
        Order|string|null $order = null,
        ?\DateTimeInterface $resultsChangedAtGte = null,
        ?\DateTimeInterface $resultsChangedAtLte = null,
        ?bool $sanctionMonitoringEnabled = null,
        Sorting|string|null $sorting = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $adverseMediaMonitoringEnabled && $self['adverseMediaMonitoringEnabled'] = $adverseMediaMonitoringEnabled;
        null !== $complianceScore && $self['complianceScore'] = $complianceScore;
        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $nextKey && $self['nextKey'] = $nextKey;
        null !== $order && $self['order'] = $order;
        null !== $resultsChangedAtGte && $self['resultsChangedAtGte'] = $resultsChangedAtGte;
        null !== $resultsChangedAtLte && $self['resultsChangedAtLte'] = $resultsChangedAtLte;
        null !== $sanctionMonitoringEnabled && $self['sanctionMonitoringEnabled'] = $sanctionMonitoringEnabled;
        null !== $sorting && $self['sorting'] = $sorting;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter checks that have entities with adverse media monitoring enabled (pending or active).
     */
    public function withAdverseMediaMonitoringEnabled(
        bool $adverseMediaMonitoringEnabled
    ): self {
        $self = clone $this;
        $self['adverseMediaMonitoringEnabled'] = $adverseMediaMonitoringEnabled;

        return $self;
    }

    /**
     * Filter by compliance score.
     *
     * @param ComplianceScore|value-of<ComplianceScore> $complianceScore
     */
    public function withComplianceScore(
        ComplianceScore|string $complianceScore
    ): self {
        $self = clone $this;
        $self['complianceScore'] = $complianceScore;

        return $self;
    }

    /**
     * Filter checks created at or after this time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Filter checks created at or before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }

    /**
     * Sorting order.
     *
     * @param Order|value-of<Order> $order
     */
    public function withOrder(Order|string $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    /**
     * Filter checks with results changed at or after this time.
     */
    public function withResultsChangedAtGte(
        \DateTimeInterface $resultsChangedAtGte
    ): self {
        $self = clone $this;
        $self['resultsChangedAtGte'] = $resultsChangedAtGte;

        return $self;
    }

    /**
     * Filter checks with results changed at or before this time.
     */
    public function withResultsChangedAtLte(
        \DateTimeInterface $resultsChangedAtLte
    ): self {
        $self = clone $this;
        $self['resultsChangedAtLte'] = $resultsChangedAtLte;

        return $self;
    }

    /**
     * Filter checks that have entities with sanction monitoring enabled (pending or active).
     */
    public function withSanctionMonitoringEnabled(
        bool $sanctionMonitoringEnabled
    ): self {
        $self = clone $this;
        $self['sanctionMonitoringEnabled'] = $sanctionMonitoringEnabled;

        return $self;
    }

    /**
     * Sorting field.
     *
     * @param Sorting|value-of<Sorting> $sorting
     */
    public function withSorting(Sorting|string $sorting): self
    {
        $self = clone $this;
        $self['sorting'] = $sorting;

        return $self;
    }

    /**
     * Filter by compliance check status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
