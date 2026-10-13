<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceCreateParams;

use Businessradar\Compliance\ComplianceCreateParams\Entity\Country;
use Businessradar\Compliance\ComplianceCreateParams\Entity\EntityType;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Compliance Entity Request.
 *
 * Represents an entity (individual or organization) to be included in a compliance
 * screening.
 *
 * @phpstan-type EntityShape = array{
 *   name: string,
 *   aliases?: list<string>|null,
 *   country?: null|Country|value-of<Country>,
 *   dateOfBirth?: string|null,
 *   entityType?: null|EntityType|value-of<EntityType>,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   middleName?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    #[Required]
    public string $name;

    /**
     * Alternative names or aliases for the compliance entity.
     *
     * @var list<string>|null $aliases
     */
    #[Optional(list: 'string')]
    public ?array $aliases;

    /**
     * ISO 3166-1 alpha-2 country code.
     *
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
     * * `ZW` - Zimbabwe
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class, nullable: true)]
    public ?string $country;

    /**
     * Date of birth. Accepts a full or partial date in YYYY, YYYY-MM or YYYY-MM-DD format (e.g. when only the year is known).
     */
    #[Optional('date_of_birth', nullable: true)]
    public ?string $dateOfBirth;

    /**
     * * `individual` - Individual
     * * `company` - Company
     * * `vessel` - Vessel.
     *
     * @var value-of<EntityType>|null $entityType
     */
    #[Optional('entity_type', enum: EntityType::class)]
    public ?string $entityType;

    #[Optional('first_name', nullable: true)]
    public ?string $firstName;

    #[Optional('last_name', nullable: true)]
    public ?string $lastName;

    #[Optional('middle_name', nullable: true)]
    public ?string $middleName;

    /**
     * `new Entity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entity::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entity)->withName(...)
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
     * @param list<string>|null $aliases
     * @param Country|value-of<Country>|null $country
     * @param EntityType|value-of<EntityType>|null $entityType
     */
    public static function with(
        string $name,
        ?array $aliases = null,
        Country|string|null $country = null,
        ?string $dateOfBirth = null,
        EntityType|string|null $entityType = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $middleName = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $aliases && $self['aliases'] = $aliases;
        null !== $country && $self['country'] = $country;
        null !== $dateOfBirth && $self['dateOfBirth'] = $dateOfBirth;
        null !== $entityType && $self['entityType'] = $entityType;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $middleName && $self['middleName'] = $middleName;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Alternative names or aliases for the compliance entity.
     *
     * @param list<string> $aliases
     */
    public function withAliases(array $aliases): self
    {
        $self = clone $this;
        $self['aliases'] = $aliases;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     *
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
     * * `ZW` - Zimbabwe
     *
     * @param Country|value-of<Country>|null $country
     */
    public function withCountry(Country|string|null $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Date of birth. Accepts a full or partial date in YYYY, YYYY-MM or YYYY-MM-DD format (e.g. when only the year is known).
     */
    public function withDateOfBirth(?string $dateOfBirth): self
    {
        $self = clone $this;
        $self['dateOfBirth'] = $dateOfBirth;

        return $self;
    }

    /**
     * * `individual` - Individual
     * * `company` - Company
     * * `vessel` - Vessel.
     *
     * @param EntityType|value-of<EntityType> $entityType
     */
    public function withEntityType(EntityType|string $entityType): self
    {
        $self = clone $this;
        $self['entityType'] = $entityType;

        return $self;
    }

    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    public function withMiddleName(?string $middleName): self
    {
        $self = clone $this;
        $self['middleName'] = $middleName;

        return $self;
    }
}
