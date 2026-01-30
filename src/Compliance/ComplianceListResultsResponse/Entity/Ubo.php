<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse\Entity;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-type UboShape = array{
 *   name: string,
 *   beneficialOwnershipPercentage?: float|null,
 *   birthDate?: string|null,
 *   degreeOfSeparation?: int|null,
 *   directOwnershipPercentage?: float|null,
 *   impliedBeneficialOwnershipPercentage?: float|null,
 *   impliedDirectOwnershipPercentage?: float|null,
 *   impliedIndirectOwnershipPercentage?: float|null,
 *   indirectOwnershipPercentage?: float|null,
 *   isBeneficiary?: bool|null,
 *   isPersonWithSignificantControl?: bool|null,
 * }
 */
final class Ubo implements BaseModel
{
    /** @use SdkModel<UboShape> */
    use SdkModel;

    #[Required]
    public string $name;

    #[Optional('beneficial_ownership_percentage', nullable: true)]
    public ?float $beneficialOwnershipPercentage;

    #[Optional('birth_date', nullable: true)]
    public ?string $birthDate;

    #[Optional('degree_of_separation', nullable: true)]
    public ?int $degreeOfSeparation;

    #[Optional('direct_ownership_percentage', nullable: true)]
    public ?float $directOwnershipPercentage;

    #[Optional('implied_beneficial_ownership_percentage', nullable: true)]
    public ?float $impliedBeneficialOwnershipPercentage;

    #[Optional('implied_direct_ownership_percentage', nullable: true)]
    public ?float $impliedDirectOwnershipPercentage;

    #[Optional('implied_indirect_ownership_percentage', nullable: true)]
    public ?float $impliedIndirectOwnershipPercentage;

    #[Optional('indirect_ownership_percentage', nullable: true)]
    public ?float $indirectOwnershipPercentage;

    #[Optional('is_beneficiary', nullable: true)]
    public ?bool $isBeneficiary;

    #[Optional('is_person_with_significant_control', nullable: true)]
    public ?bool $isPersonWithSignificantControl;

    /**
     * `new Ubo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Ubo::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Ubo)->withName(...)
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
     */
    public static function with(
        string $name,
        ?float $beneficialOwnershipPercentage = null,
        ?string $birthDate = null,
        ?int $degreeOfSeparation = null,
        ?float $directOwnershipPercentage = null,
        ?float $impliedBeneficialOwnershipPercentage = null,
        ?float $impliedDirectOwnershipPercentage = null,
        ?float $impliedIndirectOwnershipPercentage = null,
        ?float $indirectOwnershipPercentage = null,
        ?bool $isBeneficiary = null,
        ?bool $isPersonWithSignificantControl = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $beneficialOwnershipPercentage && $self['beneficialOwnershipPercentage'] = $beneficialOwnershipPercentage;
        null !== $birthDate && $self['birthDate'] = $birthDate;
        null !== $degreeOfSeparation && $self['degreeOfSeparation'] = $degreeOfSeparation;
        null !== $directOwnershipPercentage && $self['directOwnershipPercentage'] = $directOwnershipPercentage;
        null !== $impliedBeneficialOwnershipPercentage && $self['impliedBeneficialOwnershipPercentage'] = $impliedBeneficialOwnershipPercentage;
        null !== $impliedDirectOwnershipPercentage && $self['impliedDirectOwnershipPercentage'] = $impliedDirectOwnershipPercentage;
        null !== $impliedIndirectOwnershipPercentage && $self['impliedIndirectOwnershipPercentage'] = $impliedIndirectOwnershipPercentage;
        null !== $indirectOwnershipPercentage && $self['indirectOwnershipPercentage'] = $indirectOwnershipPercentage;
        null !== $isBeneficiary && $self['isBeneficiary'] = $isBeneficiary;
        null !== $isPersonWithSignificantControl && $self['isPersonWithSignificantControl'] = $isPersonWithSignificantControl;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withBeneficialOwnershipPercentage(
        ?float $beneficialOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['beneficialOwnershipPercentage'] = $beneficialOwnershipPercentage;

        return $self;
    }

    public function withBirthDate(?string $birthDate): self
    {
        $self = clone $this;
        $self['birthDate'] = $birthDate;

        return $self;
    }

    public function withDegreeOfSeparation(?int $degreeOfSeparation): self
    {
        $self = clone $this;
        $self['degreeOfSeparation'] = $degreeOfSeparation;

        return $self;
    }

    public function withDirectOwnershipPercentage(
        ?float $directOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['directOwnershipPercentage'] = $directOwnershipPercentage;

        return $self;
    }

    public function withImpliedBeneficialOwnershipPercentage(
        ?float $impliedBeneficialOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['impliedBeneficialOwnershipPercentage'] = $impliedBeneficialOwnershipPercentage;

        return $self;
    }

    public function withImpliedDirectOwnershipPercentage(
        ?float $impliedDirectOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['impliedDirectOwnershipPercentage'] = $impliedDirectOwnershipPercentage;

        return $self;
    }

    public function withImpliedIndirectOwnershipPercentage(
        ?float $impliedIndirectOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['impliedIndirectOwnershipPercentage'] = $impliedIndirectOwnershipPercentage;

        return $self;
    }

    public function withIndirectOwnershipPercentage(
        ?float $indirectOwnershipPercentage
    ): self {
        $self = clone $this;
        $self['indirectOwnershipPercentage'] = $indirectOwnershipPercentage;

        return $self;
    }

    public function withIsBeneficiary(?bool $isBeneficiary): self
    {
        $self = clone $this;
        $self['isBeneficiary'] = $isBeneficiary;

        return $self;
    }

    public function withIsPersonWithSignificantControl(
        ?bool $isPersonWithSignificantControl
    ): self {
        $self = clone $this;
        $self['isPersonWithSignificantControl'] = $isPersonWithSignificantControl;

        return $self;
    }
}
