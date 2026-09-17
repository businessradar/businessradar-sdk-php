<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Match a Single Company.
 *
 * Resolve a set of identifying details to the single best-matching company.
 *
 * Provide as many identifying details as you have. At least one of `name`,
 * `duns_number`, `registration_number` or `customer_reference` is required, and a
 * `country` must accompany a `name` or `registration_number` lookup. More fields
 * (address, telephone, url, email) yield a more confident match.
 *
 * Matching happens in two stages:
 *
 * - **Internal first.** A `customer_reference` mapped to one of your portfolio
 * companies, or a `duns_number` we already track, returns that Business Radar
 * company immediately — no Dun & Bradstreet lookup is performed.
 *
 * - **Dun & Bradstreet fallback.** Otherwise the details are matched against
 * Dun & Bradstreet's Cleanse Match API and the single best candidate is
 * returned, even if the company is not yet registered in Business Radar.
 *
 * The result is a company object. When the company is already tracked in
 * Business Radar its `external_id` is populated; when it only exists at Dun &
 * Bradstreet the `external_id` is `null` and you can register it via [POST
 * /companies](/ext/v3/#/ext/ext_v3_companies_create) using the returned
 * `duns_number`.
 *
 * Returns `404` when no company can be matched.
 *
 * @see Businessradar\Services\CompaniesService::match()
 *
 * @phpstan-type CompanyMatchParamsShape = array{
 *   addressCounty?: string|null,
 *   addressLocality?: string|null,
 *   addressRegion?: string|null,
 *   confidenceLowerLevelThresholdValue?: int|null,
 *   country?: string|null,
 *   customerReference?: string|null,
 *   dunsNumber?: string|null,
 *   email?: string|null,
 *   name?: string|null,
 *   postalCode?: string|null,
 *   registrationNumber?: string|null,
 *   registrationNumberType?: string|null,
 *   streetAddressLine1?: string|null,
 *   streetAddressLine2?: string|null,
 *   telephoneNumber?: string|null,
 *   url?: string|null,
 * }
 */
final class CompanyMatchParams implements BaseModel
{
    /** @use SdkModel<CompanyMatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * County.
     */
    #[Optional]
    public ?string $addressCounty;

    /**
     * City / locality.
     */
    #[Optional]
    public ?string $addressLocality;

    /**
     * Region / state / province.
     */
    #[Optional]
    public ?string $addressRegion;

    /**
     * Minimum Dun & Bradstreet confidence code (1-10).
     */
    #[Optional]
    public ?int $confidenceLowerLevelThresholdValue;

    /**
     * ISO 2-letter Country Code (e.g., NL, US).
     */
    #[Optional]
    public ?string $country;

    /**
     * Your own reference linking to a tracked company.
     */
    #[Optional]
    public ?string $customerReference;

    /**
     * 9-digit Dun And Bradstreet Number to match.
     */
    #[Optional]
    public ?string $dunsNumber;

    /**
     * Company email address.
     */
    #[Optional]
    public ?string $email;

    /**
     * Company name to match.
     */
    #[Optional]
    public ?string $name;

    /**
     * Postal / ZIP code.
     */
    #[Optional]
    public ?string $postalCode;

    /**
     * Local Registration Number.
     */
    #[Optional]
    public ?string $registrationNumber;

    /**
     * Type of the registration number.
     */
    #[Optional]
    public ?string $registrationNumberType;

    /**
     * First line of the street address.
     */
    #[Optional]
    public ?string $streetAddressLine1;

    /**
     * Second line of the street address.
     */
    #[Optional]
    public ?string $streetAddressLine2;

    /**
     * Telephone number.
     */
    #[Optional]
    public ?string $telephoneNumber;

    /**
     * Company website URL.
     */
    #[Optional]
    public ?string $url;

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
        ?string $addressCounty = null,
        ?string $addressLocality = null,
        ?string $addressRegion = null,
        ?int $confidenceLowerLevelThresholdValue = null,
        ?string $country = null,
        ?string $customerReference = null,
        ?string $dunsNumber = null,
        ?string $email = null,
        ?string $name = null,
        ?string $postalCode = null,
        ?string $registrationNumber = null,
        ?string $registrationNumberType = null,
        ?string $streetAddressLine1 = null,
        ?string $streetAddressLine2 = null,
        ?string $telephoneNumber = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $addressCounty && $self['addressCounty'] = $addressCounty;
        null !== $addressLocality && $self['addressLocality'] = $addressLocality;
        null !== $addressRegion && $self['addressRegion'] = $addressRegion;
        null !== $confidenceLowerLevelThresholdValue && $self['confidenceLowerLevelThresholdValue'] = $confidenceLowerLevelThresholdValue;
        null !== $country && $self['country'] = $country;
        null !== $customerReference && $self['customerReference'] = $customerReference;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $email && $self['email'] = $email;
        null !== $name && $self['name'] = $name;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $registrationNumberType && $self['registrationNumberType'] = $registrationNumberType;
        null !== $streetAddressLine1 && $self['streetAddressLine1'] = $streetAddressLine1;
        null !== $streetAddressLine2 && $self['streetAddressLine2'] = $streetAddressLine2;
        null !== $telephoneNumber && $self['telephoneNumber'] = $telephoneNumber;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * County.
     */
    public function withAddressCounty(string $addressCounty): self
    {
        $self = clone $this;
        $self['addressCounty'] = $addressCounty;

        return $self;
    }

    /**
     * City / locality.
     */
    public function withAddressLocality(string $addressLocality): self
    {
        $self = clone $this;
        $self['addressLocality'] = $addressLocality;

        return $self;
    }

    /**
     * Region / state / province.
     */
    public function withAddressRegion(string $addressRegion): self
    {
        $self = clone $this;
        $self['addressRegion'] = $addressRegion;

        return $self;
    }

    /**
     * Minimum Dun & Bradstreet confidence code (1-10).
     */
    public function withConfidenceLowerLevelThresholdValue(
        int $confidenceLowerLevelThresholdValue
    ): self {
        $self = clone $this;
        $self['confidenceLowerLevelThresholdValue'] = $confidenceLowerLevelThresholdValue;

        return $self;
    }

    /**
     * ISO 2-letter Country Code (e.g., NL, US).
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Your own reference linking to a tracked company.
     */
    public function withCustomerReference(string $customerReference): self
    {
        $self = clone $this;
        $self['customerReference'] = $customerReference;

        return $self;
    }

    /**
     * 9-digit Dun And Bradstreet Number to match.
     */
    public function withDunsNumber(string $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

        return $self;
    }

    /**
     * Company email address.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Company name to match.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Postal / ZIP code.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * Local Registration Number.
     */
    public function withRegistrationNumber(string $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    /**
     * Type of the registration number.
     */
    public function withRegistrationNumberType(
        string $registrationNumberType
    ): self {
        $self = clone $this;
        $self['registrationNumberType'] = $registrationNumberType;

        return $self;
    }

    /**
     * First line of the street address.
     */
    public function withStreetAddressLine1(string $streetAddressLine1): self
    {
        $self = clone $this;
        $self['streetAddressLine1'] = $streetAddressLine1;

        return $self;
    }

    /**
     * Second line of the street address.
     */
    public function withStreetAddressLine2(string $streetAddressLine2): self
    {
        $self = clone $this;
        $self['streetAddressLine2'] = $streetAddressLine2;

        return $self;
    }

    /**
     * Telephone number.
     */
    public function withTelephoneNumber(string $telephoneNumber): self
    {
        $self = clone $this;
        $self['telephoneNumber'] = $telephoneNumber;

        return $self;
    }

    /**
     * Company website URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
