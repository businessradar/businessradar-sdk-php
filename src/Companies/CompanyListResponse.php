<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Companies\CompanyListResponse\IndustryCode;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Universal Company.
 *
 * @phpstan-import-type IndustryCodeShape from \Businessradar\Companies\CompanyListResponse\IndustryCode
 *
 * @phpstan-type CompanyListResponseShape = array{
 *   addressPlace: string,
 *   addressPostal: string,
 *   addressRegion: string,
 *   addressStreet: string,
 *   country: string,
 *   dunsNumber: string,
 *   externalID: string|null,
 *   industryCodes: list<\Businessradar\Companies\CompanyListResponse\IndustryCode|IndustryCodeShape>,
 *   name: string,
 *   socialLogo: string|null,
 *   websiteIconURL: string|null,
 *   isOutOfBusiness?: bool|null,
 * }
 */
final class CompanyListResponse implements BaseModel
{
    /** @use SdkModel<CompanyListResponseShape> */
    use SdkModel;

    #[Required('address_place')]
    public string $addressPlace;

    #[Required('address_postal')]
    public string $addressPostal;

    #[Required('address_region')]
    public string $addressRegion;

    #[Required('address_street')]
    public string $addressStreet;

    #[Required]
    public string $country;

    #[Required('duns_number')]
    public string $dunsNumber;

    #[Required('external_id')]
    public ?string $externalID;

    /**
     * @var list<IndustryCode> $industryCodes
     */
    #[Required(
        'industry_codes',
        list: IndustryCode::class,
    )]
    public array $industryCodes;

    #[Required]
    public string $name;

    #[Required('social_logo')]
    public ?string $socialLogo;

    #[Required('website_icon_url')]
    public ?string $websiteIconURL;

    #[Optional('is_out_of_business', nullable: true)]
    public ?bool $isOutOfBusiness;

    /**
     * `new CompanyListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyListResponse::with(
     *   addressPlace: ...,
     *   addressPostal: ...,
     *   addressRegion: ...,
     *   addressStreet: ...,
     *   country: ...,
     *   dunsNumber: ...,
     *   externalID: ...,
     *   industryCodes: ...,
     *   name: ...,
     *   socialLogo: ...,
     *   websiteIconURL: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyListResponse)
     *   ->withAddressPlace(...)
     *   ->withAddressPostal(...)
     *   ->withAddressRegion(...)
     *   ->withAddressStreet(...)
     *   ->withCountry(...)
     *   ->withDunsNumber(...)
     *   ->withExternalID(...)
     *   ->withIndustryCodes(...)
     *   ->withName(...)
     *   ->withSocialLogo(...)
     *   ->withWebsiteIconURL(...)
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
     * @param list<IndustryCode|IndustryCodeShape> $industryCodes
     */
    public static function with(
        string $addressPlace,
        string $addressPostal,
        string $addressRegion,
        string $addressStreet,
        string $country,
        string $dunsNumber,
        ?string $externalID,
        array $industryCodes,
        string $name,
        ?string $socialLogo,
        ?string $websiteIconURL,
        ?bool $isOutOfBusiness = null,
    ): self {
        $self = new self;

        $self['addressPlace'] = $addressPlace;
        $self['addressPostal'] = $addressPostal;
        $self['addressRegion'] = $addressRegion;
        $self['addressStreet'] = $addressStreet;
        $self['country'] = $country;
        $self['dunsNumber'] = $dunsNumber;
        $self['externalID'] = $externalID;
        $self['industryCodes'] = $industryCodes;
        $self['name'] = $name;
        $self['socialLogo'] = $socialLogo;
        $self['websiteIconURL'] = $websiteIconURL;

        null !== $isOutOfBusiness && $self['isOutOfBusiness'] = $isOutOfBusiness;

        return $self;
    }

    public function withAddressPlace(string $addressPlace): self
    {
        $self = clone $this;
        $self['addressPlace'] = $addressPlace;

        return $self;
    }

    public function withAddressPostal(string $addressPostal): self
    {
        $self = clone $this;
        $self['addressPostal'] = $addressPostal;

        return $self;
    }

    public function withAddressRegion(string $addressRegion): self
    {
        $self = clone $this;
        $self['addressRegion'] = $addressRegion;

        return $self;
    }

    public function withAddressStreet(string $addressStreet): self
    {
        $self = clone $this;
        $self['addressStreet'] = $addressStreet;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withDunsNumber(string $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

        return $self;
    }

    public function withExternalID(?string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * @param list<IndustryCode|IndustryCodeShape> $industryCodes
     */
    public function withIndustryCodes(array $industryCodes): self
    {
        $self = clone $this;
        $self['industryCodes'] = $industryCodes;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withSocialLogo(?string $socialLogo): self
    {
        $self = clone $this;
        $self['socialLogo'] = $socialLogo;

        return $self;
    }

    public function withWebsiteIconURL(?string $websiteIconURL): self
    {
        $self = clone $this;
        $self['websiteIconURL'] = $websiteIconURL;

        return $self;
    }

    public function withIsOutOfBusiness(?bool $isOutOfBusiness): self
    {
        $self = clone $this;
        $self['isOutOfBusiness'] = $isOutOfBusiness;

        return $self;
    }
}
