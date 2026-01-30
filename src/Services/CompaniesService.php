<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListResponse;
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
     * @param string $nextKey An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
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
     * ### List Company Updates
     *
     * Retrieve a list of attribute changes for companies. This allows monitoring how
     * company data has evolved over time.
     *
     * @param \DateTimeInterface $maxCreatedAt filter updates created at or before this time
     * @param \DateTimeInterface $minCreatedAt filter updates created at or after this time
     * @param string $nextKey An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
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
