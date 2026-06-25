<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Missing Company Investigation.
 *
 * Used to request and track investigations for companies not currently in the
 * database. This is typically used when a search for a company yields no results,
 * allowing users to provide known details for a manual or automated investigation.
 *
 * @phpstan-type CompanyListMissingCompanyInvestigationsResponseShape = array{
 *   companyExternalID: string|null,
 *   country: CountryEnum|value-of<CountryEnum>,
 *   createdAt: \DateTimeInterface,
 *   externalID: string,
 *   lastStatusUpdate: \DateTimeInterface,
 *   legalName: string,
 *   status: string,
 *   addressNumber?: string|null,
 *   addressPhone?: string|null,
 *   addressPlace?: string|null,
 *   addressPostal?: string|null,
 *   addressRegion?: string|null,
 *   addressStreet?: string|null,
 *   description?: string|null,
 *   officerName?: string|null,
 *   officerTitle?: string|null,
 *   tradeName?: string|null,
 *   websiteURL?: string|null,
 * }
 */
final class CompanyListMissingCompanyInvestigationsResponse implements BaseModel
{
    /** @use SdkModel<CompanyListMissingCompanyInvestigationsResponseShape> */
    use SdkModel;

    #[Required('company_external_id')]
    public ?string $companyExternalID;

    /**
     * * `AF` - Afghanistan
     * * `AX` - Aland Islands
     * * `AL` - Albania
     * * `DZ` - Algeria
     * * `AS` - American Samoa
     * * `AD` - Andorra
     * * `AO` - Angola
     * * `AI` - Anguilla
     * * `AQ` - Antarctica
     * * `AG` - Antigua and Barbuda
     * * `AR` - Argentina
     * * `AM` - Armenia
     * * `AW` - Aruba
     * * `AU` - Australia
     * * `AT` - Austria
     * * `AZ` - Azerbaijan
     * * `BS` - Bahamas
     * * `BH` - Bahrain
     * * `BD` - Bangladesh
     * * `BB` - Barbados
     * * `BY` - Belarus
     * * `BE` - Belgium
     * * `BZ` - Belize
     * * `BJ` - Benin
     * * `BM` - Bermuda
     * * `BT` - Bhutan
     * * `BO` - Bolivia
     * * `BQ` - Bonaire
     * * `BA` - Bosnia and Herzegovina
     * * `BW` - Botswana
     * * `BV` - Bouvet Island
     * * `BR` - Brazil
     * * `IO` - British Indian Ocean Territory
     * * `BN` - Brunei Darussalam
     * * `BG` - Bulgaria
     * * `BF` - Burkina Faso
     * * `BI` - Burundi
     * * `CV` - Cabo Verde
     * * `KH` - Cambodia
     * * `CM` - Cameroon
     * * `CA` - Canada
     * * `KY` - Cayman Islands
     * * `CF` - Central African Republic
     * * `TD` - Chad
     * * `CL` - Chile
     * * `CN` - China
     * * `CX` - Christmas Island
     * * `CC` - Cocos Keeling Islands
     * * `CO` - Colombia
     * * `KM` - Comoros
     * * `CG` - Congo
     * * `CD` - Congo Democratic Republic
     * * `CK` - Cook Islands
     * * `CR` - Costa Rica
     * * `CI` - Cote d'Ivoire
     * * `HR` - Croatia
     * * `CU` - Cuba
     * * `CW` - Curacao
     * * `CY` - Cyprus
     * * `CZ` - Czechia
     * * `DK` - Denmark
     * * `DJ` - Djibouti
     * * `DM` - Dominica
     * * `DO` - Dominican Republic
     * * `EC` - Ecuador
     * * `EG` - Egypt
     * * `SV` - El Salvador
     * * `GQ` - Equatorial Guinea
     * * `ER` - Eritrea
     * * `EE` - Estonia
     * * `SZ` - Eswatini
     * * `ET` - Ethiopia
     * * `FK` - Falkland Islands
     * * `FO` - Faroe Islands
     * * `FJ` - Fiji
     * * `FI` - Finland
     * * `FR` - France
     * * `GF` - French Guiana
     * * `PF` - French Polynesia
     * * `TF` - French Southern Territories
     * * `GA` - Gabon
     * * `GM` - Gambia
     * * `GE` - Georgia
     * * `DE` - Germany
     * * `GH` - Ghana
     * * `GI` - Gibraltar
     * * `GR` - Greece
     * * `GL` - Greenland
     * * `GD` - Grenada
     * * `GP` - Guadeloupe
     * * `GU` - Guam
     * * `GT` - Guatemala
     * * `GG` - Guernsey
     * * `GN` - Guinea
     * * `GW` - Guinea-Bissau
     * * `GY` - Guyana
     * * `HT` - Haiti
     * * `HM` - Heard Island and McDonald Islands
     * * `VA` - Holy See
     * * `HN` - Honduras
     * * `HK` - Hong Kong
     * * `HU` - Hungary
     * * `IS` - Iceland
     * * `IN` - India
     * * `ID` - Indonesia
     * * `IR` - Iran (Islamic Republic of)
     * * `IQ` - Iraq
     * * `IE` - Ireland
     * * `IM` - Isle of Man
     * * `IL` - Israel
     * * `IT` - Italy
     * * `JM` - Jamaica
     * * `JP` - Japan
     * * `JE` - Jersey
     * * `JO` - Jordan
     * * `KZ` - Kazakhstan
     * * `KE` - Kenya
     * * `KI` - Kiribati
     * * `KP` - Korea (the Democratic People's Republic of)
     * * `KR` - Korea (the Republic of)
     * * `XK` - Kosovo
     * * `KW` - Kuwait
     * * `KG` - Kyrgyzstan
     * * `LA` - Lao People's Democratic Republic
     * * `LV` - Latvia
     * * `LB` - Lebanon
     * * `LS` - Lesotho
     * * `LR` - Liberia
     * * `LY` - Libya
     * * `LI` - Liechtenstein
     * * `LT` - Lithuania
     * * `LU` - Luxembourg
     * * `MO` - Macao
     * * `MG` - Madagascar
     * * `MW` - Malawi
     * * `MY` - Malaysia
     * * `MV` - Maldives
     * * `ML` - Mali
     * * `MT` - Malta
     * * `MH` - Marshall Islands
     * * `MQ` - Martinique
     * * `MR` - Mauritania
     * * `MU` - Mauritius
     * * `YT` - Mayotte
     * * `MX` - Mexico
     * * `FM` - Micronesia
     * * `MD` - Moldova
     * * `MC` - Monaco
     * * `MN` - Mongolia
     * * `ME` - Montenegro
     * * `MS` - Montserrat
     * * `MA` - Morocco
     * * `MZ` - Mozambique
     * * `MM` - Myanmar
     * * `NA` - Namibia
     * * `NR` - Nauru
     * * `NP` - Nepal
     * * `NL` - Netherlands
     * * `NC` - New Caledonia
     * * `NZ` - New Zealand
     * * `NI` - Nicaragua
     * * `NE` - Niger
     * * `NG` - Nigeria
     * * `NU` - Niue
     * * `NF` - Norfolk Island
     * * `MK` - North Macedonia
     * * `MP` - Northern Mariana Islands
     * * `NO` - Norway
     * * `OM` - Oman
     * * `PK` - Pakistan
     * * `PW` - Palau
     * * `PS` - Palestine, State of
     * * `PA` - Panama
     * * `PG` - Papua New Guinea
     * * `PY` - Paraguay
     * * `PE` - Peru
     * * `PH` - Philippines
     * * `PN` - Pitcairn
     * * `PL` - Poland
     * * `PT` - Portugal
     * * `PR` - Puerto Rico
     * * `QA` - Qatar
     * * `RE` - Réunion
     * * `RO` - Romania
     * * `RU` - Russian Federation
     * * `RW` - Rwanda
     * * `BL` - Saint Barthélemy
     * * `SH` - Saint Helena
     * * `KN` - Saint Kitts and Nevis
     * * `LC` - Saint Lucia
     * * `MF` - Saint Martin
     * * `PM` - Saint Pierre and Miquelon
     * * `VC` - Saint Vincent and the Grenadines
     * * `WS` - Samoa
     * * `SM` - San Marino
     * * `ST` - Sao Tome and Principe
     * * `SA` - Saudi Arabia
     * * `SN` - Senegal
     * * `RS` - Serbia
     * * `SC` - Seychelles
     * * `SL` - Sierra Leone
     * * `SG` - Singapore
     * * `SX` - Sint Maarten
     * * `SK` - Slovakia
     * * `SI` - Slovenia
     * * `SB` - Solomon Islands
     * * `SO` - Somalia
     * * `ZA` - South Africa
     * * `GS` - South Georgia and the South Sandwich Islands
     * * `SS` - South Sudan
     * * `ES` - Spain
     * * `LK` - Sri Lanka
     * * `SD` - Sudan
     * * `SR` - Suriname
     * * `SJ` - Svalbard and Jan Mayen
     * * `SE` - Sweden
     * * `CH` - Switzerland
     * * `SY` - Syrian Arab Republic
     * * `TW` - Taiwan
     * * `TJ` - Tajikistan
     * * `TZ` - Tanzania
     * * `TH` - Thailand
     * * `TL` - Timor-Leste
     * * `TG` - Togo
     * * `TK` - Tokelau
     * * `TO` - Tonga
     * * `TT` - Trinidad and Tobago
     * * `TN` - Tunisia
     * * `TR` - Turkey
     * * `TM` - Turkmenistan
     * * `TC` - Turks and Caicos Islands
     * * `TV` - Tuvalu
     * * `UG` - Uganda
     * * `UA` - Ukraine
     * * `AE` - United Arab Emirates
     * * `GB` - United Kingdom
     * * `UM` - United States Minor Outlying Islands
     * * `US` - United States of America
     * * `UY` - Uruguay
     * * `UZ` - Uzbekistan
     * * `VU` - Vanuatu
     * * `VE` - Venezuela
     * * `VN` - Viet Nam
     * * `VG` - Virgin Islands
     * * `VI` - Virgin Islands
     * * `WF` - Wallis and Futuna
     * * `EH` - Western Sahara
     * * `YE` - Yemen
     * * `ZM` - Zambia
     * * `ZW` - Zimbabwe.
     *
     * @var value-of<CountryEnum> $country
     */
    #[Required(enum: CountryEnum::class)]
    public string $country;

    /**
     * The date and time when this investigation was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('external_id')]
    public string $externalID;

    #[Required('last_status_update')]
    public \DateTimeInterface $lastStatusUpdate;

    /**
     * Official name of the company as registered in legal documents.
     */
    #[Required('legal_name')]
    public string $legalName;

    #[Required]
    public string $status;

    #[Optional('address_number', nullable: true)]
    public ?string $addressNumber;

    /**
     * Phone number should include international code prefix, e.g., +31.
     */
    #[Optional('address_phone', nullable: true)]
    public ?string $addressPhone;

    #[Optional('address_place', nullable: true)]
    public ?string $addressPlace;

    #[Optional('address_postal', nullable: true)]
    public ?string $addressPostal;

    #[Optional('address_region', nullable: true)]
    public ?string $addressRegion;

    #[Optional('address_street', nullable: true)]
    public ?string $addressStreet;

    /**
     * Any additional notes or details about the company.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Name of the primary officer or CEO of the company.
     */
    #[Optional('officer_name', nullable: true)]
    public ?string $officerName;

    /**
     * Title or position of the named officer in the company.
     */
    #[Optional('officer_title', nullable: true)]
    public ?string $officerTitle;

    /**
     * Alternate name the company might use in its operations, distinct from the legal name.
     */
    #[Optional('trade_name', nullable: true)]
    public ?string $tradeName;

    /**
     * Provide the official website of the company if available.
     */
    #[Optional('website_url', nullable: true)]
    public ?string $websiteURL;

    /**
     * `new CompanyListMissingCompanyInvestigationsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyListMissingCompanyInvestigationsResponse::with(
     *   companyExternalID: ...,
     *   country: ...,
     *   createdAt: ...,
     *   externalID: ...,
     *   lastStatusUpdate: ...,
     *   legalName: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyListMissingCompanyInvestigationsResponse)
     *   ->withCompanyExternalID(...)
     *   ->withCountry(...)
     *   ->withCreatedAt(...)
     *   ->withExternalID(...)
     *   ->withLastStatusUpdate(...)
     *   ->withLegalName(...)
     *   ->withStatus(...)
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
     * @param CountryEnum|value-of<CountryEnum> $country
     */
    public static function with(
        ?string $companyExternalID,
        CountryEnum|string $country,
        \DateTimeInterface $createdAt,
        string $externalID,
        \DateTimeInterface $lastStatusUpdate,
        string $legalName,
        string $status,
        ?string $addressNumber = null,
        ?string $addressPhone = null,
        ?string $addressPlace = null,
        ?string $addressPostal = null,
        ?string $addressRegion = null,
        ?string $addressStreet = null,
        ?string $description = null,
        ?string $officerName = null,
        ?string $officerTitle = null,
        ?string $tradeName = null,
        ?string $websiteURL = null,
    ): self {
        $self = new self;

        $self['companyExternalID'] = $companyExternalID;
        $self['country'] = $country;
        $self['createdAt'] = $createdAt;
        $self['externalID'] = $externalID;
        $self['lastStatusUpdate'] = $lastStatusUpdate;
        $self['legalName'] = $legalName;
        $self['status'] = $status;

        null !== $addressNumber && $self['addressNumber'] = $addressNumber;
        null !== $addressPhone && $self['addressPhone'] = $addressPhone;
        null !== $addressPlace && $self['addressPlace'] = $addressPlace;
        null !== $addressPostal && $self['addressPostal'] = $addressPostal;
        null !== $addressRegion && $self['addressRegion'] = $addressRegion;
        null !== $addressStreet && $self['addressStreet'] = $addressStreet;
        null !== $description && $self['description'] = $description;
        null !== $officerName && $self['officerName'] = $officerName;
        null !== $officerTitle && $self['officerTitle'] = $officerTitle;
        null !== $tradeName && $self['tradeName'] = $tradeName;
        null !== $websiteURL && $self['websiteURL'] = $websiteURL;

        return $self;
    }

    public function withCompanyExternalID(?string $companyExternalID): self
    {
        $self = clone $this;
        $self['companyExternalID'] = $companyExternalID;

        return $self;
    }

    /**
     * * `AF` - Afghanistan
     * * `AX` - Aland Islands
     * * `AL` - Albania
     * * `DZ` - Algeria
     * * `AS` - American Samoa
     * * `AD` - Andorra
     * * `AO` - Angola
     * * `AI` - Anguilla
     * * `AQ` - Antarctica
     * * `AG` - Antigua and Barbuda
     * * `AR` - Argentina
     * * `AM` - Armenia
     * * `AW` - Aruba
     * * `AU` - Australia
     * * `AT` - Austria
     * * `AZ` - Azerbaijan
     * * `BS` - Bahamas
     * * `BH` - Bahrain
     * * `BD` - Bangladesh
     * * `BB` - Barbados
     * * `BY` - Belarus
     * * `BE` - Belgium
     * * `BZ` - Belize
     * * `BJ` - Benin
     * * `BM` - Bermuda
     * * `BT` - Bhutan
     * * `BO` - Bolivia
     * * `BQ` - Bonaire
     * * `BA` - Bosnia and Herzegovina
     * * `BW` - Botswana
     * * `BV` - Bouvet Island
     * * `BR` - Brazil
     * * `IO` - British Indian Ocean Territory
     * * `BN` - Brunei Darussalam
     * * `BG` - Bulgaria
     * * `BF` - Burkina Faso
     * * `BI` - Burundi
     * * `CV` - Cabo Verde
     * * `KH` - Cambodia
     * * `CM` - Cameroon
     * * `CA` - Canada
     * * `KY` - Cayman Islands
     * * `CF` - Central African Republic
     * * `TD` - Chad
     * * `CL` - Chile
     * * `CN` - China
     * * `CX` - Christmas Island
     * * `CC` - Cocos Keeling Islands
     * * `CO` - Colombia
     * * `KM` - Comoros
     * * `CG` - Congo
     * * `CD` - Congo Democratic Republic
     * * `CK` - Cook Islands
     * * `CR` - Costa Rica
     * * `CI` - Cote d'Ivoire
     * * `HR` - Croatia
     * * `CU` - Cuba
     * * `CW` - Curacao
     * * `CY` - Cyprus
     * * `CZ` - Czechia
     * * `DK` - Denmark
     * * `DJ` - Djibouti
     * * `DM` - Dominica
     * * `DO` - Dominican Republic
     * * `EC` - Ecuador
     * * `EG` - Egypt
     * * `SV` - El Salvador
     * * `GQ` - Equatorial Guinea
     * * `ER` - Eritrea
     * * `EE` - Estonia
     * * `SZ` - Eswatini
     * * `ET` - Ethiopia
     * * `FK` - Falkland Islands
     * * `FO` - Faroe Islands
     * * `FJ` - Fiji
     * * `FI` - Finland
     * * `FR` - France
     * * `GF` - French Guiana
     * * `PF` - French Polynesia
     * * `TF` - French Southern Territories
     * * `GA` - Gabon
     * * `GM` - Gambia
     * * `GE` - Georgia
     * * `DE` - Germany
     * * `GH` - Ghana
     * * `GI` - Gibraltar
     * * `GR` - Greece
     * * `GL` - Greenland
     * * `GD` - Grenada
     * * `GP` - Guadeloupe
     * * `GU` - Guam
     * * `GT` - Guatemala
     * * `GG` - Guernsey
     * * `GN` - Guinea
     * * `GW` - Guinea-Bissau
     * * `GY` - Guyana
     * * `HT` - Haiti
     * * `HM` - Heard Island and McDonald Islands
     * * `VA` - Holy See
     * * `HN` - Honduras
     * * `HK` - Hong Kong
     * * `HU` - Hungary
     * * `IS` - Iceland
     * * `IN` - India
     * * `ID` - Indonesia
     * * `IR` - Iran (Islamic Republic of)
     * * `IQ` - Iraq
     * * `IE` - Ireland
     * * `IM` - Isle of Man
     * * `IL` - Israel
     * * `IT` - Italy
     * * `JM` - Jamaica
     * * `JP` - Japan
     * * `JE` - Jersey
     * * `JO` - Jordan
     * * `KZ` - Kazakhstan
     * * `KE` - Kenya
     * * `KI` - Kiribati
     * * `KP` - Korea (the Democratic People's Republic of)
     * * `KR` - Korea (the Republic of)
     * * `XK` - Kosovo
     * * `KW` - Kuwait
     * * `KG` - Kyrgyzstan
     * * `LA` - Lao People's Democratic Republic
     * * `LV` - Latvia
     * * `LB` - Lebanon
     * * `LS` - Lesotho
     * * `LR` - Liberia
     * * `LY` - Libya
     * * `LI` - Liechtenstein
     * * `LT` - Lithuania
     * * `LU` - Luxembourg
     * * `MO` - Macao
     * * `MG` - Madagascar
     * * `MW` - Malawi
     * * `MY` - Malaysia
     * * `MV` - Maldives
     * * `ML` - Mali
     * * `MT` - Malta
     * * `MH` - Marshall Islands
     * * `MQ` - Martinique
     * * `MR` - Mauritania
     * * `MU` - Mauritius
     * * `YT` - Mayotte
     * * `MX` - Mexico
     * * `FM` - Micronesia
     * * `MD` - Moldova
     * * `MC` - Monaco
     * * `MN` - Mongolia
     * * `ME` - Montenegro
     * * `MS` - Montserrat
     * * `MA` - Morocco
     * * `MZ` - Mozambique
     * * `MM` - Myanmar
     * * `NA` - Namibia
     * * `NR` - Nauru
     * * `NP` - Nepal
     * * `NL` - Netherlands
     * * `NC` - New Caledonia
     * * `NZ` - New Zealand
     * * `NI` - Nicaragua
     * * `NE` - Niger
     * * `NG` - Nigeria
     * * `NU` - Niue
     * * `NF` - Norfolk Island
     * * `MK` - North Macedonia
     * * `MP` - Northern Mariana Islands
     * * `NO` - Norway
     * * `OM` - Oman
     * * `PK` - Pakistan
     * * `PW` - Palau
     * * `PS` - Palestine, State of
     * * `PA` - Panama
     * * `PG` - Papua New Guinea
     * * `PY` - Paraguay
     * * `PE` - Peru
     * * `PH` - Philippines
     * * `PN` - Pitcairn
     * * `PL` - Poland
     * * `PT` - Portugal
     * * `PR` - Puerto Rico
     * * `QA` - Qatar
     * * `RE` - Réunion
     * * `RO` - Romania
     * * `RU` - Russian Federation
     * * `RW` - Rwanda
     * * `BL` - Saint Barthélemy
     * * `SH` - Saint Helena
     * * `KN` - Saint Kitts and Nevis
     * * `LC` - Saint Lucia
     * * `MF` - Saint Martin
     * * `PM` - Saint Pierre and Miquelon
     * * `VC` - Saint Vincent and the Grenadines
     * * `WS` - Samoa
     * * `SM` - San Marino
     * * `ST` - Sao Tome and Principe
     * * `SA` - Saudi Arabia
     * * `SN` - Senegal
     * * `RS` - Serbia
     * * `SC` - Seychelles
     * * `SL` - Sierra Leone
     * * `SG` - Singapore
     * * `SX` - Sint Maarten
     * * `SK` - Slovakia
     * * `SI` - Slovenia
     * * `SB` - Solomon Islands
     * * `SO` - Somalia
     * * `ZA` - South Africa
     * * `GS` - South Georgia and the South Sandwich Islands
     * * `SS` - South Sudan
     * * `ES` - Spain
     * * `LK` - Sri Lanka
     * * `SD` - Sudan
     * * `SR` - Suriname
     * * `SJ` - Svalbard and Jan Mayen
     * * `SE` - Sweden
     * * `CH` - Switzerland
     * * `SY` - Syrian Arab Republic
     * * `TW` - Taiwan
     * * `TJ` - Tajikistan
     * * `TZ` - Tanzania
     * * `TH` - Thailand
     * * `TL` - Timor-Leste
     * * `TG` - Togo
     * * `TK` - Tokelau
     * * `TO` - Tonga
     * * `TT` - Trinidad and Tobago
     * * `TN` - Tunisia
     * * `TR` - Turkey
     * * `TM` - Turkmenistan
     * * `TC` - Turks and Caicos Islands
     * * `TV` - Tuvalu
     * * `UG` - Uganda
     * * `UA` - Ukraine
     * * `AE` - United Arab Emirates
     * * `GB` - United Kingdom
     * * `UM` - United States Minor Outlying Islands
     * * `US` - United States of America
     * * `UY` - Uruguay
     * * `UZ` - Uzbekistan
     * * `VU` - Vanuatu
     * * `VE` - Venezuela
     * * `VN` - Viet Nam
     * * `VG` - Virgin Islands
     * * `VI` - Virgin Islands
     * * `WF` - Wallis and Futuna
     * * `EH` - Western Sahara
     * * `YE` - Yemen
     * * `ZM` - Zambia
     * * `ZW` - Zimbabwe.
     *
     * @param CountryEnum|value-of<CountryEnum> $country
     */
    public function withCountry(CountryEnum|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The date and time when this investigation was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withLastStatusUpdate(
        \DateTimeInterface $lastStatusUpdate
    ): self {
        $self = clone $this;
        $self['lastStatusUpdate'] = $lastStatusUpdate;

        return $self;
    }

    /**
     * Official name of the company as registered in legal documents.
     */
    public function withLegalName(string $legalName): self
    {
        $self = clone $this;
        $self['legalName'] = $legalName;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withAddressNumber(?string $addressNumber): self
    {
        $self = clone $this;
        $self['addressNumber'] = $addressNumber;

        return $self;
    }

    /**
     * Phone number should include international code prefix, e.g., +31.
     */
    public function withAddressPhone(?string $addressPhone): self
    {
        $self = clone $this;
        $self['addressPhone'] = $addressPhone;

        return $self;
    }

    public function withAddressPlace(?string $addressPlace): self
    {
        $self = clone $this;
        $self['addressPlace'] = $addressPlace;

        return $self;
    }

    public function withAddressPostal(?string $addressPostal): self
    {
        $self = clone $this;
        $self['addressPostal'] = $addressPostal;

        return $self;
    }

    public function withAddressRegion(?string $addressRegion): self
    {
        $self = clone $this;
        $self['addressRegion'] = $addressRegion;

        return $self;
    }

    public function withAddressStreet(?string $addressStreet): self
    {
        $self = clone $this;
        $self['addressStreet'] = $addressStreet;

        return $self;
    }

    /**
     * Any additional notes or details about the company.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Name of the primary officer or CEO of the company.
     */
    public function withOfficerName(?string $officerName): self
    {
        $self = clone $this;
        $self['officerName'] = $officerName;

        return $self;
    }

    /**
     * Title or position of the named officer in the company.
     */
    public function withOfficerTitle(?string $officerTitle): self
    {
        $self = clone $this;
        $self['officerTitle'] = $officerTitle;

        return $self;
    }

    /**
     * Alternate name the company might use in its operations, distinct from the legal name.
     */
    public function withTradeName(?string $tradeName): self
    {
        $self = clone $this;
        $self['tradeName'] = $tradeName;

        return $self;
    }

    /**
     * Provide the official website of the company if available.
     */
    public function withWebsiteURL(?string $websiteURL): self
    {
        $self = clone $this;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }
}
