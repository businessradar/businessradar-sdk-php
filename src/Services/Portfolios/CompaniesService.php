<?php

declare(strict_types=1);

namespace Businessradar\Services\Portfolios;

use Businessradar\Client;
use Businessradar\Companies\Registration;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\Portfolios\Companies\CompanyCreateParams\Country;
use Businessradar\Portfolios\Companies\CompanyListResponse;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Portfolios\CompaniesContract;

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
     * Register a new Portfolio Company.
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
        $response = $this->raw->create($portfolioID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List And Create Portfolio Companies.
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
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($portfolioID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove Portfolio Companies.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $externalID,
        string $portfolioID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['portfolioID' => $portfolioID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($externalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
