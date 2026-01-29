<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Create a new compliance check.
 *
 * @see Businessradar\Services\ComplianceService::create()
 *
 * @phpstan-type ComplianceCreateParamsShape = array{
 *   allEntitiesScreeningEnabled?: bool|null,
 *   companyID?: string|null,
 *   directorsScreeningEnabled?: bool|null,
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

    #[Optional('directors_screening_enabled')]
    public ?bool $directorsScreeningEnabled;

    #[Optional('ownership_screening_threshold')]
    public ?float $ownershipScreeningThreshold;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $allEntitiesScreeningEnabled = null,
        ?string $companyID = null,
        ?bool $directorsScreeningEnabled = null,
        ?float $ownershipScreeningThreshold = null,
    ): self {
        $self = new self;

        null !== $allEntitiesScreeningEnabled && $self['allEntitiesScreeningEnabled'] = $allEntitiesScreeningEnabled;
        null !== $companyID && $self['companyID'] = $companyID;
        null !== $directorsScreeningEnabled && $self['directorsScreeningEnabled'] = $directorsScreeningEnabled;
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

    public function withDirectorsScreeningEnabled(
        bool $directorsScreeningEnabled
    ): self {
        $self = clone $this;
        $self['directorsScreeningEnabled'] = $directorsScreeningEnabled;

        return $self;
    }

    public function withOwnershipScreeningThreshold(
        float $ownershipScreeningThreshold
    ): self {
        $self = clone $this;
        $self['ownershipScreeningThreshold'] = $ownershipScreeningThreshold;

        return $self;
    }
}
