<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResponse;

use Businessradar\Companies\CountryEnum;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-type CompanyShape = array{
 *   country: CountryEnum|value-of<CountryEnum>,
 *   name: string,
 *   externalID?: string|null,
 * }
 */
final class Company implements BaseModel
{
    /** @use SdkModel<CompanyShape> */
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

    #[Required]
    public string $name;

    #[Optional('external_id')]
    public ?string $externalID;

    /**
     * `new Company()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Company::with(country: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Company)->withCountry(...)->withName(...)
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
        CountryEnum|string $country,
        string $name,
        ?string $externalID = null
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['name'] = $name;

        null !== $externalID && $self['externalID'] = $externalID;

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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }
}
