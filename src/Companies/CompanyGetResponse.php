<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Companies\CompanyGetResponse\RegistrationNumber;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Company.
 *
 * Detailed representation of a company in Business Radar.
 *
 * This data includes: - Basic info (name, country, website) - Identification (DUNS,
 * external ID, registration numbers) - Industry classifications - Geographical data
 * (address, coordinates) - Social and online presence - Summary metrics (article
 * count, review scores, etc.)
 *
 * @phpstan-import-type IndustryCodeShape from \Businessradar\Companies\IndustryCode
 * @phpstan-import-type RegistrationNumberShape from \Businessradar\Companies\CompanyGetResponse\RegistrationNumber
 *
 * @phpstan-type CompanyGetResponseShape = array{
 *   country: CountryEnum|value-of<CountryEnum>,
 *   dunsNumber: string,
 *   foundingDate: string,
 *   industryCodes: list<IndustryCode|IndustryCodeShape>,
 *   name: string,
 *   primaryIndustryCodes: list<IndustryCode|IndustryCodeShape>,
 *   registrationNumbers: list<RegistrationNumber|RegistrationNumberShape>,
 *   slug: string,
 *   socialDescription: string|null,
 *   socialLogo: string|null,
 *   tradeNames: list<string>,
 *   addressLatitude?: float|null,
 *   addressLongitude?: float|null,
 *   addressNumber?: string|null,
 *   addressPhone?: string|null,
 *   addressPlace?: string|null,
 *   addressPostal?: string|null,
 *   addressRegion?: string|null,
 *   addressStreet?: string|null,
 *   articleCount?: int|null,
 *   externalID?: string|null,
 *   isOutOfBusiness?: bool|null,
 *   linkedinURL?: string|null,
 *   publicationCount?: int|null,
 *   reportCount?: int|null,
 *   reviewAverageScore?: float|null,
 *   reviewCount?: int|null,
 *   tickerSymbol?: string|null,
 *   websiteDomain?: string|null,
 *   websiteIconURL?: string|null,
 *   websiteURL?: string|null,
 * }
 */
final class CompanyGetResponse implements BaseModel
{
    /** @use SdkModel<CompanyGetResponseShape> */
    use SdkModel;

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

    #[Required('duns_number')]
    public string $dunsNumber;

    #[Required('founding_date')]
    public string $foundingDate;

    /** @var list<IndustryCode> $industryCodes */
    #[Required('industry_codes', list: IndustryCode::class)]
    public array $industryCodes;

    #[Required]
    public string $name;

    /** @var list<IndustryCode> $primaryIndustryCodes */
    #[Required('primary_industry_codes', list: IndustryCode::class)]
    public array $primaryIndustryCodes;

    /** @var list<RegistrationNumber> $registrationNumbers */
    #[Required('registration_numbers', list: RegistrationNumber::class)]
    public array $registrationNumbers;

    #[Required]
    public string $slug;

    /**
     * Get Social Description.
     */
    #[Required('social_description')]
    public ?string $socialDescription;

    /**
     * Get Social Logo.
     */
    #[Required('social_logo')]
    public ?string $socialLogo;

    /** @var list<string> $tradeNames */
    #[Required('trade_names', list: 'string')]
    public array $tradeNames;

    #[Optional('address_latitude', nullable: true)]
    public ?float $addressLatitude;

    #[Optional('address_longitude', nullable: true)]
    public ?float $addressLongitude;

    #[Optional('address_number', nullable: true)]
    public ?string $addressNumber;

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
     * Amount of articles available.
     */
    #[Optional('article_count')]
    public ?int $articleCount;

    #[Optional('external_id')]
    public ?string $externalID;

    /**
     * Indicates whether the company is out of business.
     */
    #[Optional('is_out_of_business')]
    public ?bool $isOutOfBusiness;

    #[Optional('linkedin_url', nullable: true)]
    public ?string $linkedinURL;

    /**
     * Amount of publications available.
     */
    #[Optional('publication_count')]
    public ?int $publicationCount;

    /**
     * Amount of reports available.
     */
    #[Optional('report_count')]
    public ?int $reportCount;

    /**
     * Average review score.
     */
    #[Optional('review_average_score', nullable: true)]
    public ?float $reviewAverageScore;

    /**
     * Amount of reviews available.
     */
    #[Optional('review_count')]
    public ?int $reviewCount;

    #[Optional('ticker_symbol', nullable: true)]
    public ?string $tickerSymbol;

    #[Optional('website_domain', nullable: true)]
    public ?string $websiteDomain;

    /**
     * Icon of the found website.
     */
    #[Optional('website_icon_url', nullable: true)]
    public ?string $websiteIconURL;

    #[Optional('website_url', nullable: true)]
    public ?string $websiteURL;

    /**
     * `new CompanyGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyGetResponse::with(
     *   country: ...,
     *   dunsNumber: ...,
     *   foundingDate: ...,
     *   industryCodes: ...,
     *   name: ...,
     *   primaryIndustryCodes: ...,
     *   registrationNumbers: ...,
     *   slug: ...,
     *   socialDescription: ...,
     *   socialLogo: ...,
     *   tradeNames: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyGetResponse)
     *   ->withCountry(...)
     *   ->withDunsNumber(...)
     *   ->withFoundingDate(...)
     *   ->withIndustryCodes(...)
     *   ->withName(...)
     *   ->withPrimaryIndustryCodes(...)
     *   ->withRegistrationNumbers(...)
     *   ->withSlug(...)
     *   ->withSocialDescription(...)
     *   ->withSocialLogo(...)
     *   ->withTradeNames(...)
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
     * @param list<IndustryCode|IndustryCodeShape> $industryCodes
     * @param list<IndustryCode|IndustryCodeShape> $primaryIndustryCodes
     * @param list<RegistrationNumber|RegistrationNumberShape> $registrationNumbers
     * @param list<string> $tradeNames
     */
    public static function with(
        CountryEnum|string $country,
        string $dunsNumber,
        string $foundingDate,
        array $industryCodes,
        string $name,
        array $primaryIndustryCodes,
        array $registrationNumbers,
        string $slug,
        ?string $socialDescription,
        ?string $socialLogo,
        array $tradeNames,
        ?float $addressLatitude = null,
        ?float $addressLongitude = null,
        ?string $addressNumber = null,
        ?string $addressPhone = null,
        ?string $addressPlace = null,
        ?string $addressPostal = null,
        ?string $addressRegion = null,
        ?string $addressStreet = null,
        ?int $articleCount = null,
        ?string $externalID = null,
        ?bool $isOutOfBusiness = null,
        ?string $linkedinURL = null,
        ?int $publicationCount = null,
        ?int $reportCount = null,
        ?float $reviewAverageScore = null,
        ?int $reviewCount = null,
        ?string $tickerSymbol = null,
        ?string $websiteDomain = null,
        ?string $websiteIconURL = null,
        ?string $websiteURL = null,
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['dunsNumber'] = $dunsNumber;
        $self['foundingDate'] = $foundingDate;
        $self['industryCodes'] = $industryCodes;
        $self['name'] = $name;
        $self['primaryIndustryCodes'] = $primaryIndustryCodes;
        $self['registrationNumbers'] = $registrationNumbers;
        $self['slug'] = $slug;
        $self['socialDescription'] = $socialDescription;
        $self['socialLogo'] = $socialLogo;
        $self['tradeNames'] = $tradeNames;

        null !== $addressLatitude && $self['addressLatitude'] = $addressLatitude;
        null !== $addressLongitude && $self['addressLongitude'] = $addressLongitude;
        null !== $addressNumber && $self['addressNumber'] = $addressNumber;
        null !== $addressPhone && $self['addressPhone'] = $addressPhone;
        null !== $addressPlace && $self['addressPlace'] = $addressPlace;
        null !== $addressPostal && $self['addressPostal'] = $addressPostal;
        null !== $addressRegion && $self['addressRegion'] = $addressRegion;
        null !== $addressStreet && $self['addressStreet'] = $addressStreet;
        null !== $articleCount && $self['articleCount'] = $articleCount;
        null !== $externalID && $self['externalID'] = $externalID;
        null !== $isOutOfBusiness && $self['isOutOfBusiness'] = $isOutOfBusiness;
        null !== $linkedinURL && $self['linkedinURL'] = $linkedinURL;
        null !== $publicationCount && $self['publicationCount'] = $publicationCount;
        null !== $reportCount && $self['reportCount'] = $reportCount;
        null !== $reviewAverageScore && $self['reviewAverageScore'] = $reviewAverageScore;
        null !== $reviewCount && $self['reviewCount'] = $reviewCount;
        null !== $tickerSymbol && $self['tickerSymbol'] = $tickerSymbol;
        null !== $websiteDomain && $self['websiteDomain'] = $websiteDomain;
        null !== $websiteIconURL && $self['websiteIconURL'] = $websiteIconURL;
        null !== $websiteURL && $self['websiteURL'] = $websiteURL;

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

    public function withDunsNumber(string $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

        return $self;
    }

    public function withFoundingDate(string $foundingDate): self
    {
        $self = clone $this;
        $self['foundingDate'] = $foundingDate;

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

    /**
     * @param list<IndustryCode|IndustryCodeShape> $primaryIndustryCodes
     */
    public function withPrimaryIndustryCodes(array $primaryIndustryCodes): self
    {
        $self = clone $this;
        $self['primaryIndustryCodes'] = $primaryIndustryCodes;

        return $self;
    }

    /**
     * @param list<RegistrationNumber|RegistrationNumberShape> $registrationNumbers
     */
    public function withRegistrationNumbers(array $registrationNumbers): self
    {
        $self = clone $this;
        $self['registrationNumbers'] = $registrationNumbers;

        return $self;
    }

    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Get Social Description.
     */
    public function withSocialDescription(?string $socialDescription): self
    {
        $self = clone $this;
        $self['socialDescription'] = $socialDescription;

        return $self;
    }

    /**
     * Get Social Logo.
     */
    public function withSocialLogo(?string $socialLogo): self
    {
        $self = clone $this;
        $self['socialLogo'] = $socialLogo;

        return $self;
    }

    /**
     * @param list<string> $tradeNames
     */
    public function withTradeNames(array $tradeNames): self
    {
        $self = clone $this;
        $self['tradeNames'] = $tradeNames;

        return $self;
    }

    public function withAddressLatitude(?float $addressLatitude): self
    {
        $self = clone $this;
        $self['addressLatitude'] = $addressLatitude;

        return $self;
    }

    public function withAddressLongitude(?float $addressLongitude): self
    {
        $self = clone $this;
        $self['addressLongitude'] = $addressLongitude;

        return $self;
    }

    public function withAddressNumber(?string $addressNumber): self
    {
        $self = clone $this;
        $self['addressNumber'] = $addressNumber;

        return $self;
    }

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
     * Amount of articles available.
     */
    public function withArticleCount(int $articleCount): self
    {
        $self = clone $this;
        $self['articleCount'] = $articleCount;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * Indicates whether the company is out of business.
     */
    public function withIsOutOfBusiness(bool $isOutOfBusiness): self
    {
        $self = clone $this;
        $self['isOutOfBusiness'] = $isOutOfBusiness;

        return $self;
    }

    public function withLinkedinURL(?string $linkedinURL): self
    {
        $self = clone $this;
        $self['linkedinURL'] = $linkedinURL;

        return $self;
    }

    /**
     * Amount of publications available.
     */
    public function withPublicationCount(int $publicationCount): self
    {
        $self = clone $this;
        $self['publicationCount'] = $publicationCount;

        return $self;
    }

    /**
     * Amount of reports available.
     */
    public function withReportCount(int $reportCount): self
    {
        $self = clone $this;
        $self['reportCount'] = $reportCount;

        return $self;
    }

    /**
     * Average review score.
     */
    public function withReviewAverageScore(?float $reviewAverageScore): self
    {
        $self = clone $this;
        $self['reviewAverageScore'] = $reviewAverageScore;

        return $self;
    }

    /**
     * Amount of reviews available.
     */
    public function withReviewCount(int $reviewCount): self
    {
        $self = clone $this;
        $self['reviewCount'] = $reviewCount;

        return $self;
    }

    public function withTickerSymbol(?string $tickerSymbol): self
    {
        $self = clone $this;
        $self['tickerSymbol'] = $tickerSymbol;

        return $self;
    }

    public function withWebsiteDomain(?string $websiteDomain): self
    {
        $self = clone $this;
        $self['websiteDomain'] = $websiteDomain;

        return $self;
    }

    /**
     * Icon of the found website.
     */
    public function withWebsiteIconURL(?string $websiteIconURL): self
    {
        $self = clone $this;
        $self['websiteIconURL'] = $websiteIconURL;

        return $self;
    }

    public function withWebsiteURL(?string $websiteURL): self
    {
        $self = clone $this;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }
}
