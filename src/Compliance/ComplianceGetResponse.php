<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Compliance\ComplianceGetResponse\ActivityScore;
use Businessradar\Compliance\ComplianceGetResponse\AdverseMediaScore;
use Businessradar\Compliance\ComplianceGetResponse\ComplianceScore;
use Businessradar\Compliance\ComplianceGetResponse\CountryScore;
use Businessradar\Compliance\ComplianceGetResponse\Entity;
use Businessradar\Compliance\ComplianceGetResponse\PepScore;
use Businessradar\Compliance\ComplianceGetResponse\SanctionScore;
use Businessradar\Compliance\ComplianceGetResponse\Status;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type EntityShape from \Businessradar\Compliance\ComplianceGetResponse\Entity
 *
 * @phpstan-type ComplianceGetResponseShape = array{
 *   entities: list<Entity|EntityShape>,
 *   externalID: string,
 *   progress: float,
 *   activityScore?: null|ActivityScore|value-of<ActivityScore>,
 *   adverseMediaScore?: null|AdverseMediaScore|value-of<AdverseMediaScore>,
 *   complianceScore?: null|ComplianceScore|value-of<ComplianceScore>,
 *   countryScore?: null|CountryScore|value-of<CountryScore>,
 *   pepScore?: null|PepScore|value-of<PepScore>,
 *   sanctionScore?: null|SanctionScore|value-of<SanctionScore>,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ComplianceGetResponse implements BaseModel
{
    /** @use SdkModel<ComplianceGetResponseShape> */
    use SdkModel;

    /** @var list<Entity> $entities */
    #[Required(list: Entity::class)]
    public array $entities;

    #[Required('external_id')]
    public string $externalID;

    #[Required]
    public float $progress;

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

    /** @var value-of<PepScore>|null $pepScore */
    #[Optional('pep_score', enum: PepScore::class, nullable: true)]
    public ?string $pepScore;

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
     * `new ComplianceGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ComplianceGetResponse::with(entities: ..., externalID: ..., progress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ComplianceGetResponse)
     *   ->withEntities(...)
     *   ->withExternalID(...)
     *   ->withProgress(...)
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
     * @param list<Entity|EntityShape> $entities
     * @param ActivityScore|value-of<ActivityScore>|null $activityScore
     * @param AdverseMediaScore|value-of<AdverseMediaScore>|null $adverseMediaScore
     * @param ComplianceScore|value-of<ComplianceScore>|null $complianceScore
     * @param CountryScore|value-of<CountryScore>|null $countryScore
     * @param PepScore|value-of<PepScore>|null $pepScore
     * @param SanctionScore|value-of<SanctionScore>|null $sanctionScore
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        array $entities,
        string $externalID,
        float $progress,
        ActivityScore|string|null $activityScore = null,
        AdverseMediaScore|string|null $adverseMediaScore = null,
        ComplianceScore|string|null $complianceScore = null,
        CountryScore|string|null $countryScore = null,
        PepScore|string|null $pepScore = null,
        SanctionScore|string|null $sanctionScore = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['entities'] = $entities;
        $self['externalID'] = $externalID;
        $self['progress'] = $progress;

        null !== $activityScore && $self['activityScore'] = $activityScore;
        null !== $adverseMediaScore && $self['adverseMediaScore'] = $adverseMediaScore;
        null !== $complianceScore && $self['complianceScore'] = $complianceScore;
        null !== $countryScore && $self['countryScore'] = $countryScore;
        null !== $pepScore && $self['pepScore'] = $pepScore;
        null !== $sanctionScore && $self['sanctionScore'] = $sanctionScore;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<Entity|EntityShape> $entities
     */
    public function withEntities(array $entities): self
    {
        $self = clone $this;
        $self['entities'] = $entities;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withProgress(float $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

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

    /**
     * @param PepScore|value-of<PepScore>|null $pepScore
     */
    public function withPepScore(PepScore|string|null $pepScore): self
    {
        $self = clone $this;
        $self['pepScore'] = $pepScore;

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
}
