<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Compliance\ComplianceListResponse\ActivityScore;
use Businessradar\Compliance\ComplianceListResponse\AdverseMediaScore;
use Businessradar\Compliance\ComplianceListResponse\Company;
use Businessradar\Compliance\ComplianceListResponse\ComplianceScore;
use Businessradar\Compliance\ComplianceListResponse\CountryScore;
use Businessradar\Compliance\ComplianceListResponse\PepScore;
use Businessradar\Compliance\ComplianceListResponse\SanctionScore;
use Businessradar\Compliance\ComplianceListResponse\Status;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Compliance Check (List).
 *
 * Lightweight representation used in list responses.
 *
 * @phpstan-import-type CompanyShape from \Businessradar\Compliance\ComplianceListResponse\Company
 *
 * @phpstan-type ComplianceListResponseShape = array{
 *   company: null|Company|CompanyShape,
 *   createdAt: \DateTimeInterface,
 *   externalID: string,
 *   activityScore?: null|ActivityScore|value-of<ActivityScore>,
 *   adverseMediaScore?: null|AdverseMediaScore|value-of<AdverseMediaScore>,
 *   complianceScore?: null|ComplianceScore|value-of<ComplianceScore>,
 *   countryScore?: null|CountryScore|value-of<CountryScore>,
 *   finishedAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   pepScore?: null|PepScore|value-of<PepScore>,
 *   resultsChangedAt?: \DateTimeInterface|null,
 *   reviewedResultsCount?: int|null,
 *   sanctionScore?: null|SanctionScore|value-of<SanctionScore>,
 *   status?: null|Status|value-of<Status>,
 *   unreviewedResultsCount?: int|null,
 * }
 */
final class ComplianceListResponse implements BaseModel
{
    /** @use SdkModel<ComplianceListResponseShape> */
    use SdkModel;

    #[Required]
    public ?Company $company;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('external_id')]
    public string $externalID;

    /** @var value-of<ActivityScore>|null $activityScore */
    #[Optional('activity_score', enum: ActivityScore::class, nullable: true)]
    public ?string $activityScore;

    /** @var value-of<AdverseMediaScore>|null $adverseMediaScore */
    #[Optional(
        'adverse_media_score',
        enum: AdverseMediaScore::class,
        nullable: true
    )]
    public ?string $adverseMediaScore;

    /** @var value-of<ComplianceScore>|null $complianceScore */
    #[Optional('compliance_score', enum: ComplianceScore::class, nullable: true)]
    public ?string $complianceScore;

    /** @var value-of<CountryScore>|null $countryScore */
    #[Optional('country_score', enum: CountryScore::class, nullable: true)]
    public ?string $countryScore;

    #[Optional('finished_at', nullable: true)]
    public ?\DateTimeInterface $finishedAt;

    /**
     * Custom name for this compliance check.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /** @var value-of<PepScore>|null $pepScore */
    #[Optional('pep_score', enum: PepScore::class, nullable: true)]
    public ?string $pepScore;

    #[Optional('results_changed_at', nullable: true)]
    public ?\DateTimeInterface $resultsChangedAt;

    /**
     * Number of results across all entities that have been reviewed by a user.
     */
    #[Optional('reviewed_results_count')]
    public ?int $reviewedResultsCount;

    /** @var value-of<SanctionScore>|null $sanctionScore */
    #[Optional('sanction_score', enum: SanctionScore::class, nullable: true)]
    public ?string $sanctionScore;

    /**
     * * `pending` - Pending
     * * `queued` - Queued
     * * `in_progress` - In Progress
     * * `searching_directors` - Searching Directors
     * * `completed` - Completed
     * * `failed` - Failed.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Number of results across all entities that are open and not yet reviewed.
     */
    #[Optional('unreviewed_results_count')]
    public ?int $unreviewedResultsCount;

    /**
     * `new ComplianceListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ComplianceListResponse::with(company: ..., createdAt: ..., externalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ComplianceListResponse)
     *   ->withCompany(...)
     *   ->withCreatedAt(...)
     *   ->withExternalID(...)
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
     * @param Company|CompanyShape|null $company
     * @param ActivityScore|value-of<ActivityScore>|null $activityScore
     * @param AdverseMediaScore|value-of<AdverseMediaScore>|null $adverseMediaScore
     * @param ComplianceScore|value-of<ComplianceScore>|null $complianceScore
     * @param CountryScore|value-of<CountryScore>|null $countryScore
     * @param PepScore|value-of<PepScore>|null $pepScore
     * @param SanctionScore|value-of<SanctionScore>|null $sanctionScore
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        Company|array|null $company,
        \DateTimeInterface $createdAt,
        string $externalID,
        ActivityScore|string|null $activityScore = null,
        AdverseMediaScore|string|null $adverseMediaScore = null,
        ComplianceScore|string|null $complianceScore = null,
        CountryScore|string|null $countryScore = null,
        ?\DateTimeInterface $finishedAt = null,
        ?string $name = null,
        PepScore|string|null $pepScore = null,
        ?\DateTimeInterface $resultsChangedAt = null,
        ?int $reviewedResultsCount = null,
        SanctionScore|string|null $sanctionScore = null,
        Status|string|null $status = null,
        ?int $unreviewedResultsCount = null,
    ): self {
        $self = new self;

        $self['company'] = $company;
        $self['createdAt'] = $createdAt;
        $self['externalID'] = $externalID;

        null !== $activityScore && $self['activityScore'] = $activityScore;
        null !== $adverseMediaScore && $self['adverseMediaScore'] = $adverseMediaScore;
        null !== $complianceScore && $self['complianceScore'] = $complianceScore;
        null !== $countryScore && $self['countryScore'] = $countryScore;
        null !== $finishedAt && $self['finishedAt'] = $finishedAt;
        null !== $name && $self['name'] = $name;
        null !== $pepScore && $self['pepScore'] = $pepScore;
        null !== $resultsChangedAt && $self['resultsChangedAt'] = $resultsChangedAt;
        null !== $reviewedResultsCount && $self['reviewedResultsCount'] = $reviewedResultsCount;
        null !== $sanctionScore && $self['sanctionScore'] = $sanctionScore;
        null !== $status && $self['status'] = $status;
        null !== $unreviewedResultsCount && $self['unreviewedResultsCount'] = $unreviewedResultsCount;

        return $self;
    }

    /**
     * @param Company|CompanyShape|null $company
     */
    public function withCompany(Company|array|null $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * @param ActivityScore|value-of<ActivityScore>|null $activityScore
     */
    public function withActivityScore(
        ActivityScore|string|null $activityScore
    ): self {
        $self = clone $this;
        $self['activityScore'] = $activityScore;

        return $self;
    }

    /**
     * @param AdverseMediaScore|value-of<AdverseMediaScore>|null $adverseMediaScore
     */
    public function withAdverseMediaScore(
        AdverseMediaScore|string|null $adverseMediaScore
    ): self {
        $self = clone $this;
        $self['adverseMediaScore'] = $adverseMediaScore;

        return $self;
    }

    /**
     * @param ComplianceScore|value-of<ComplianceScore>|null $complianceScore
     */
    public function withComplianceScore(
        ComplianceScore|string|null $complianceScore
    ): self {
        $self = clone $this;
        $self['complianceScore'] = $complianceScore;

        return $self;
    }

    /**
     * @param CountryScore|value-of<CountryScore>|null $countryScore
     */
    public function withCountryScore(
        CountryScore|string|null $countryScore
    ): self {
        $self = clone $this;
        $self['countryScore'] = $countryScore;

        return $self;
    }

    public function withFinishedAt(?\DateTimeInterface $finishedAt): self
    {
        $self = clone $this;
        $self['finishedAt'] = $finishedAt;

        return $self;
    }

    /**
     * Custom name for this compliance check.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param PepScore|value-of<PepScore>|null $pepScore
     */
    public function withPepScore(PepScore|string|null $pepScore): self
    {
        $self = clone $this;
        $self['pepScore'] = $pepScore;

        return $self;
    }

    public function withResultsChangedAt(
        ?\DateTimeInterface $resultsChangedAt
    ): self {
        $self = clone $this;
        $self['resultsChangedAt'] = $resultsChangedAt;

        return $self;
    }

    /**
     * Number of results across all entities that have been reviewed by a user.
     */
    public function withReviewedResultsCount(int $reviewedResultsCount): self
    {
        $self = clone $this;
        $self['reviewedResultsCount'] = $reviewedResultsCount;

        return $self;
    }

    /**
     * @param SanctionScore|value-of<SanctionScore>|null $sanctionScore
     */
    public function withSanctionScore(
        SanctionScore|string|null $sanctionScore
    ): self {
        $self = clone $this;
        $self['sanctionScore'] = $sanctionScore;

        return $self;
    }

    /**
     * * `pending` - Pending
     * * `queued` - Queued
     * * `in_progress` - In Progress
     * * `searching_directors` - Searching Directors
     * * `completed` - Completed
     * * `failed` - Failed.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Number of results across all entities that are open and not yet reviewed.
     */
    public function withUnreviewedResultsCount(
        int $unreviewedResultsCount
    ): self {
        $self = clone $this;
        $self['unreviewedResultsCount'] = $unreviewedResultsCount;

        return $self;
    }
}
