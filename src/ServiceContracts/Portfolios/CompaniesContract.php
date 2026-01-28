<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Portfolios;

use Businessradar\Companies\Registration;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\Portfolios\Companies\CompanyCreateParams\Country;
use Businessradar\Portfolios\Companies\CompanyListResponse;
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
        string $portfolioID,
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
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<CompanyListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $portfolioID,
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
    public function delete(
        string $externalID,
        string $portfolioID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
