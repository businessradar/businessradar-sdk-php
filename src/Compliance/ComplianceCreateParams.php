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
 * Initiate a new compliance screening using one of two methods:
 *
 * 1. **Company-based screening**: Provide a `company_id` to screen the company.
 * Optionally enable screening of related entities (UBOs and directors) via
 * `ubo_screening_enabled` and `directors_screening_enabled`. You can optionally
 * include a list of additional `entities` to be screened alongside the company.
 *
 * 2. **Custom entity screening**: Provide a list of `entities` without a
 * `company_id` to screen specific individuals or organizations that are not
 * necessarily affiliated with a company in our database.
 *
 * Once posted, Business Radar processes the request in the background.
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
 *   uboScreeningEnabled?: bool|null,
 * }
 */
final class ComplianceCreateParams implements BaseModel
{
    /** @use SdkModel<ComplianceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If enabled all found entities (UBOs, directors, shareholders) will be screened. This can have a high cost impact.
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

    /**
     * If enabled, UBOs discovered for the company will be screened.
     */
    #[Optional('ubo_screening_enabled')]
    public ?bool $uboScreeningEnabled;

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
        ?bool $uboScreeningEnabled = null,
    ): self {
        $self = new self;

        null !== $allEntitiesScreeningEnabled && $self['allEntitiesScreeningEnabled'] = $allEntitiesScreeningEnabled;
        null !== $companyID && $self['companyID'] = $companyID;
        null !== $directorsScreeningEnabled && $self['directorsScreeningEnabled'] = $directorsScreeningEnabled;
        null !== $entities && $self['entities'] = $entities;
        null !== $ownershipScreeningThreshold && $self['ownershipScreeningThreshold'] = $ownershipScreeningThreshold;
        null !== $uboScreeningEnabled && $self['uboScreeningEnabled'] = $uboScreeningEnabled;

        return $self;
    }

    /**
     * If enabled all found entities (UBOs, directors, shareholders) will be screened. This can have a high cost impact.
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

    /**
     * If enabled, UBOs discovered for the company will be screened.
     */
    public function withUboScreeningEnabled(bool $uboScreeningEnabled): self
    {
        $self = clone $this;
        $self['uboScreeningEnabled'] = $uboScreeningEnabled;

        return $self;
    }
}
