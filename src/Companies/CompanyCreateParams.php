<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\PortfolioCompanyDetailRequest;

/**
 * Register new Company to Business Radar.
 *
 * @see Businessradar\Services\CompaniesService::create()
 *
 * @phpstan-import-type PortfolioCompanyDetailRequestShape from \Businessradar\PortfolioCompanyDetailRequest
 *
 * @phpstan-type CompanyCreateParamsShape = array{
 *   company?: null|PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape,
 *   country?: null|Country|value-of<Country>,
 *   customerReference?: string|null,
 *   dunsNumber?: string|null,
 *   primaryName?: string|null,
 *   registrationNumber?: string|null,
 * }
 */
final class CompanyCreateParams implements BaseModel
{
    /** @use SdkModel<CompanyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Portfolio Company Detail Serializer.
     *
     * Alternative serializer for the Company model which is limited.
     */
    #[Optional(nullable: true)]
    public ?PortfolioCompanyDetailRequest $company;

    /** @var value-of<Country>|null $country */
    #[Optional(enum: Country::class, nullable: true)]
    public ?string $country;

    /**
     * Customer reference for the client to understand relationship.
     */
    #[Optional('customer_reference', nullable: true)]
    public ?string $customerReference;

    #[Optional('duns_number', nullable: true)]
    public ?string $dunsNumber;

    #[Optional('primary_name', nullable: true)]
    public ?string $primaryName;

    #[Optional('registration_number', nullable: true)]
    public ?string $registrationNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null $company
     * @param Country|value-of<Country>|null $country
     */
    public static function with(
        PortfolioCompanyDetailRequest|array|null $company = null,
        Country|string|null $country = null,
        ?string $customerReference = null,
        ?string $dunsNumber = null,
        ?string $primaryName = null,
        ?string $registrationNumber = null,
    ): self {
        $self = new self;

        null !== $company && $self['company'] = $company;
        null !== $country && $self['country'] = $country;
        null !== $customerReference && $self['customerReference'] = $customerReference;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $primaryName && $self['primaryName'] = $primaryName;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    /**
     * Portfolio Company Detail Serializer.
     *
     * Alternative serializer for the Company model which is limited.
     *
     * @param PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null $company
     */
    public function withCompany(
        PortfolioCompanyDetailRequest|array|null $company
    ): self {
        $self = clone $this;
        $self['company'] = $company;

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

    /**
     * Customer reference for the client to understand relationship.
     */
    public function withCustomerReference(?string $customerReference): self
    {
        $self = clone $this;
        $self['customerReference'] = $customerReference;

        return $self;
    }

    public function withDunsNumber(?string $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

        return $self;
    }

    public function withPrimaryName(?string $primaryName): self
    {
        $self = clone $this;
        $self['primaryName'] = $primaryName;

        return $self;
    }

    public function withRegistrationNumber(?string $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }
}
