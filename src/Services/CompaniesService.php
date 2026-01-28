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
     * Register new Company to Business Radar.
     *
     * @param PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null $company Portfolio Company Detail Serializer.
     *
     * Alternative serializer for the Company model which is limited.
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
     * Get Company Information.
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
     * Search all companies using Dun and Bradstreet.
     *
     * Companies will contain an optional external_id, which is null if company is not
     * registered in Business Radar.
     *
     * When you pass query and optional country it will search using dun and
     * bradstreet, otherwise using internal search.
     *
     * @param list<string> $country ISO 2-letter Country Code
     * @param list<string> $dunsNumber 9-digit Dun And Bradstreet Number
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
     * @param list<string> $portfolioID Portfolio ID to filter companies
     * @param string $query custom search query to text search all companies
     * @param list<string> $registrationNumber Local Registration Number
     * @param string $websiteURL Website URL to search
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
     * List Company Updates.
     *
     * @param \DateTimeInterface $maxCreatedAt filter updates created at or before this time
     * @param \DateTimeInterface $minCreatedAt filter updates created at or after this time
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
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
     * Get Registration Information.
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
