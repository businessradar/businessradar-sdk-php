<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Companies\CompanyCreateFeedbackParams\FeedbackType;
use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Companies\CompanyGetMissingCompanyInvestigationResponse;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListMissingCompanyInvestigationsResponse;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\CompanyNewFeedbackResponse;
use Businessradar\Companies\CompanyNewMissingCompanyInvestigationResponse;
use Businessradar\Companies\CountryEnum;
use Businessradar\Companies\Registration;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\CompaniesContract;

/**
 * @phpstan-import-type PortfolioCompanyDetailRequestShape from \Businessradar\PortfolioCompanyDetailRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class CompaniesService implements CompaniesContract
{
    /**
     * @api
     */
    public CompaniesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CompaniesRawService($client);
    }

    /**
     * @api
     *
     * ### Register Company (Asynchronous)
     *
     * Register a new company to Business Radar using its identification details. Once
     * posted, Business Radar processes the request in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the [GET
     * /registrations/{registration_id}](/ext/v3/#/ext/ext_v3_registrations_retrieve)
     * endpoint.
     *
     * If the company is already registered, the existing registration will be
     * returned.
     *
     * @param PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null $company ### Portfolio Company Detail (Simplified)
     *
     * A lightweight data structure for company identification (UUID, DUNS, Name, Country)
     * @param Country|value-of<Country>|null $country
     * @param string|null $customerReference customer reference for the client to understand relationship
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        PortfolioCompanyDetailRequest|array|null $company = null,
        Country|string|null $country = null,
        ?string $customerReference = null,
        ?string $dunsNumber = null,
        ?string $primaryName = null,
        ?string $registrationNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): Registration {
        $params = Util::removeNulls(
            [
                'company' => $company,
                'country' => $country,
                'customerReference' => $customerReference,
                'dunsNumber' => $dunsNumber,
                'primaryName' => $primaryName,
                'registrationNumber' => $registrationNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Retrieve Company Information
     *
     * Fetch detailed information about a specific company using its `external_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): CompanyGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($externalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Search Companies
     *
     * Search for companies across internal and external databases.
     *
     * - If `query` and an optional `country` are provided, the search is primarily
     * conducted via Dun & Bradstreet.
     *
     * - If other filters (like `portfolio_id`) are provided, the search is limited to
     * our internal database.
     *
     * The results include an `external_id` if the company is already registered in
     * Business Radar.
     *
     * @param list<string> $country ISO 2-letter Country Code (e.g., NL, US)
     * @param list<string> $dunsNumber 9-digit Dun And Bradstreet Number (can be multiple)
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param list<string> $portfolioID Filter companies belonging to specific Portfolio IDs (UUID)
     * @param string $query custom search query to text search all companies
     * @param list<string> $registrationNumber Local Registration Number (can be multiple)
     * @param string $websiteURL Website URL to search for the company
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<CompanyListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?array $country = null,
        ?array $dunsNumber = null,
        ?string $nextKey = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $websiteURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): NextKey {
        $params = Util::removeNulls(
            [
                'country' => $country,
                'dunsNumber' => $dunsNumber,
                'nextKey' => $nextKey,
                'portfolioID' => $portfolioID,
                'query' => $query,
                'registrationNumber' => $registrationNumber,
                'websiteURL' => $websiteURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Submit Company Feedback
     *
     * Submit feedback about a specific company. If feedback already exists for
     * the same company and profile, the existing record is updated.
     *
     * Optionally provide a `notification_email` to be notified when the feedback
     * is resolved.
     *
     * @param FeedbackType|value-of<FeedbackType> $feedbackType * `NOT_ENOUGH_NEWS` - Not Enough News
     * * `COMPANY_NAME_OUTDATED` - Company Name Outdated
     * * `INCORRECT_COMPANY_WEBSITE` - Incorrect Company Website
     * * `MISSING_REGISTRATION_NUMBER` - Missing Registration Number
     * * `MISSING_TRADE_NAME` - Missing Trade Name
     * * `INCORRECT_TRADE_NAME` - Incorrect Trade Name
     * * `NOT_ENOUGH_REVIEWS` - Not Enough Reviews
     * * `OUTDATED_CORPORATE_LINKAGE` - Outdated Corporate Linkage
     * * `INCORRECT_CORPORATE_LINKAGE` - Incorrect Corporate Linkage
     * * `OTHER` - Other
     * @param string|null $notificationEmail email address to notify when feedback is resolved
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createFeedback(
        string $company,
        FeedbackType|string $feedbackType,
        ?string $comment = null,
        ?string $notificationEmail = null,
        ?string $tradeName = null,
        RequestOptions|array|null $requestOptions = null,
    ): CompanyNewFeedbackResponse {
        $params = Util::removeNulls(
            [
                'company' => $company,
                'feedbackType' => $feedbackType,
                'comment' => $comment,
                'notificationEmail' => $notificationEmail,
                'tradeName' => $tradeName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFeedback(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Submit Missing Company Investigation (Asynchronous)
     *
     * Submit a new investigation for a company that could not be found. Once
     * submitted, Business Radar processes the investigation in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the GET
     * endpoint.
     *
     * @param CountryEnum|value-of<CountryEnum> $country * `AF` - Afghanistan
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
     * @param string $legalName official name of the company as registered in legal documents
     * @param string|null $addressPhone Phone number should include international code prefix, e.g., +31.
     * @param string|null $description any additional notes or details about the company
     * @param string|null $officerName name of the primary officer or CEO of the company
     * @param string|null $officerTitle title or position of the named officer in the company
     * @param string|null $tradeName alternate name the company might use in its operations, distinct from the legal name
     * @param string|null $websiteURL provide the official website of the company if available
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createMissingCompanyInvestigation(
        CountryEnum|string $country,
        string $legalName,
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
        RequestOptions|array|null $requestOptions = null,
    ): CompanyNewMissingCompanyInvestigationResponse {
        $params = Util::removeNulls(
            [
                'country' => $country,
                'legalName' => $legalName,
                'addressNumber' => $addressNumber,
                'addressPhone' => $addressPhone,
                'addressPlace' => $addressPlace,
                'addressPostal' => $addressPostal,
                'addressRegion' => $addressRegion,
                'addressStreet' => $addressStreet,
                'description' => $description,
                'officerName' => $officerName,
                'officerTitle' => $officerTitle,
                'tradeName' => $tradeName,
                'websiteURL' => $websiteURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createMissingCompanyInvestigation(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### List Company Updates
     *
     * Retrieve a list of attribute changes for companies. This allows monitoring how
     * company data has evolved over time.
     *
     * @param \DateTimeInterface $maxCreatedAt filter updates created at or before this time
     * @param \DateTimeInterface $minCreatedAt filter updates created at or after this time
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<CompanyListAttributeChangesResponse>
     *
     * @throws APIException
     */
    public function listAttributeChanges(
        ?\DateTimeInterface $maxCreatedAt = null,
        ?\DateTimeInterface $minCreatedAt = null,
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): NextKey {
        $params = Util::removeNulls(
            [
                'maxCreatedAt' => $maxCreatedAt,
                'minCreatedAt' => $minCreatedAt,
                'nextKey' => $nextKey,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAttributeChanges(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Missing Company Investigations
     *
     * List existing investigations or submit a new one for a company that could not be
     * found.
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<CompanyListMissingCompanyInvestigationsResponse>
     *
     * @throws APIException
     */
    public function listMissingCompanyInvestigations(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listMissingCompanyInvestigations(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Retrieve Missing Company Investigation
     *
     * Fetch details about a specific missing company investigation using its
     * `external_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveMissingCompanyInvestigation(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): CompanyGetMissingCompanyInvestigationResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveMissingCompanyInvestigation($externalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Retrieve Registration Information
     *
     * Fetch details about a specific company registration request using its
     * `registration_id`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveRegistration(
        string $registrationID,
        RequestOptions|array|null $requestOptions = null
    ): Registration {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveRegistration($registrationID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
