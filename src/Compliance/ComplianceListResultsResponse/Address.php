<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

use Businessradar\Compliance\ComplianceListResultsResponse\Address\Country;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Compliance entity result address.
 *
 * @phpstan-type AddressShape = array{
 *   city?: string|null,
 *   country?: null|Country|value-of<Country>,
 *   postalCode?: string|null,
 *   street?: string|null,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $city;

    /** @var value-of<Country>|null $country */
    #[Optional(enum: Country::class, nullable: true)]
    public ?string $country;

    #[Optional('postal_code', nullable: true)]
    public ?string $postalCode;

    #[Optional(nullable: true)]
    public ?string $street;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Country|value-of<Country>|null $country
     */
    public static function with(
        ?string $city = null,
        Country|string|null $country = null,
        ?string $postalCode = null,
        ?string $street = null,
    ): self {
        $self = new self;

        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $street && $self['street'] = $street;

        return $self;
    }

    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * @param Country|value-of<Country>|null $country
     */
    public function withCountry(Country|string|null $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withPostalCode(?string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    public function withStreet(?string $street): self
    {
        $self = clone $this;
        $self['street'] = $street;

        return $self;
    }
}
