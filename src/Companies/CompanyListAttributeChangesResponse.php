<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Company Attribute Change.
 *
 * Tracks changes to specific attributes of a company over time. Used for monitoring
 * updates and maintaining a history of company data.
 *
 * @phpstan-type CompanyListAttributeChangesResponseShape = array{
 *   attribute: string,
 *   companyExternalID: string,
 *   createdAt: \DateTimeInterface,
 *   newValue?: string|null,
 *   oldValue?: string|null,
 * }
 */
final class CompanyListAttributeChangesResponse implements BaseModel
{
    /** @use SdkModel<CompanyListAttributeChangesResponseShape> */
    use SdkModel;

    #[Required]
    public string $attribute;

    #[Required('company_external_id')]
    public string $companyExternalID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Optional('new_value', nullable: true)]
    public ?string $newValue;

    #[Optional('old_value', nullable: true)]
    public ?string $oldValue;

    /**
     * `new CompanyListAttributeChangesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyListAttributeChangesResponse::with(
     *   attribute: ..., companyExternalID: ..., createdAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyListAttributeChangesResponse)
     *   ->withAttribute(...)
     *   ->withCompanyExternalID(...)
     *   ->withCreatedAt(...)
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
        string $attribute,
        string $companyExternalID,
        \DateTimeInterface $createdAt,
        ?string $newValue = null,
        ?string $oldValue = null,
    ): self {
        $self = new self;

        $self['attribute'] = $attribute;
        $self['companyExternalID'] = $companyExternalID;
        $self['createdAt'] = $createdAt;

        null !== $newValue && $self['newValue'] = $newValue;
        null !== $oldValue && $self['oldValue'] = $oldValue;

        return $self;
    }

    public function withAttribute(string $attribute): self
    {
        $self = clone $this;
        $self['attribute'] = $attribute;

        return $self;
    }

    public function withCompanyExternalID(string $companyExternalID): self
    {
        $self = clone $this;
        $self['companyExternalID'] = $companyExternalID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withNewValue(?string $newValue): self
    {
        $self = clone $this;
        $self['newValue'] = $newValue;

        return $self;
    }

    public function withOldValue(?string $oldValue): self
    {
        $self = clone $this;
        $self['oldValue'] = $oldValue;

        return $self;
    }
}
