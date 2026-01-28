<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\Registration;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type PortfolioCompanyDetailRequestShape from \Businessradar\PortfolioCompanyDetailRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface CompaniesContract
{
    /**
     * @api
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
    ): Registration;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): CompanyGetResponse;

    /**
     * @api
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
    ): NextKey;

    /**
     * @api
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
    ): NextKey;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveRegistration(
        string $registrationID,
        RequestOptions|array|null $requestOptions = null
    ): Registration;
}
