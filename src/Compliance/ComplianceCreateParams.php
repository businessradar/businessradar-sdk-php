<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Create Compliance Check (Asynchronous).
 *
 * Initiate a new compliance screening for either a specific company or a custom
 * list of entities. Once posted, Business Radar processes the request in the
 * background.
 *
 * To check the progress and/or retrieve the final result, you can use the [GET
 * /compliance/{external_id}](/ext/v3/#/ext/ext_v3_compliance_retrieve) endpoint.
 *
 * @see Businessradar\Services\ComplianceService::create()
 *
 * @phpstan-import-type EntityShape from \Businessradar\Compliance\ComplianceCreateParams\Entity
 *
 * @phpstan-type ComplianceCreateParamsShape = array{
 *   allEntitiesScreeningEnabled?: bool|null,
 *   companyID?: string|null,
 *   directorsScreeningEnabled?: bool|null,
 *   entities?: list<Entity|EntityShape>|null,
 *   ownershipScreeningThreshold?: float|null,
 * }
 */
final class ComplianceCreateParams implements BaseModel
{
    /** @use SdkModel<ComplianceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If enabled all found entities UBOs, directors, shareholders will be screened. This can have an high cost impact.
     */
    #[Optional('all_entities_screening_enabled')]
    public ?bool $allEntitiesScreeningEnabled;

    #[Optional('company_id', nullable: true)]
    public ?string $companyID;

    /**
     * If directors should be screened.
     */
    #[Optional('directors_screening_enabled')]
    public ?bool $directorsScreeningEnabled;

    /** @var list<Entity>|null $entities */
    #[Optional(list: Entity::class)]
    public ?array $entities;

    /**
     * The threshold for ultimate ownership to enable for screening.
     */
    #[Optional('ownership_screening_threshold', nullable: true)]
    public ?float $ownershipScreeningThreshold;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Entity|EntityShape>|null $entities
     */
    public static function with(
        ?bool $allEntitiesScreeningEnabled = null,
        ?string $companyID = null,
        ?bool $directorsScreeningEnabled = null,
        ?array $entities = null,
        ?float $ownershipScreeningThreshold = null,
    ): self {
        $self = new self;

        null !== $allEntitiesScreeningEnabled && $self['allEntitiesScreeningEnabled'] = $allEntitiesScreeningEnabled;
        null !== $companyID && $self['companyID'] = $companyID;
        null !== $directorsScreeningEnabled && $self['directorsScreeningEnabled'] = $directorsScreeningEnabled;
        null !== $entities && $self['entities'] = $entities;
        null !== $ownershipScreeningThreshold && $self['ownershipScreeningThreshold'] = $ownershipScreeningThreshold;

        return $self;
    }

    /**
     * If enabled all found entities UBOs, directors, shareholders will be screened. This can have an high cost impact.
     */
    public function withAllEntitiesScreeningEnabled(
        bool $allEntitiesScreeningEnabled
    ): self {
        $self = clone $this;
        $self['allEntitiesScreeningEnabled'] = $allEntitiesScreeningEnabled;

        return $self;
    }

    public function withCompanyID(?string $companyID): self
    {
        $self = clone $this;
        $self['companyID'] = $companyID;

        return $self;
    }

    /**
     * If directors should be screened.
     */
    public function withDirectorsScreeningEnabled(
        bool $directorsScreeningEnabled
    ): self {
        $self = clone $this;
        $self['directorsScreeningEnabled'] = $directorsScreeningEnabled;

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

    /**
     * The threshold for ultimate ownership to enable for screening.
     */
    public function withOwnershipScreeningThreshold(
        ?float $ownershipScreeningThreshold
    ): self {
        $self = clone $this;
        $self['ownershipScreeningThreshold'] = $ownershipScreeningThreshold;

        return $self;
    }
}
