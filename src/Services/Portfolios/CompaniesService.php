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
     * ### Register Portfolio Company (Asynchronous)
     *
     * Register and add a new company to the portfolio. Once posted, Business Radar
     * processes the request in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the [GET
     * /registrations/{registration_id}](/ext/v3/#/ext/ext_v3_registrations_retrieve)
     * endpoint.
     *
     * @param PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null $company ### Portfolio Company Detail (Simplified)
     *
     * A lightweight data structure for company identification (UUID, DUNS, Name, Country)
     * @param Country|value-of<Country>|null $country
     * @param string|null $customerReference customer reference for the client to understand relationship
     * @param bool $submitInvestigationWhenNotIdentified with this option enabled a missing company investigation is submitted automatically when the registration cannot be identified, instead of failing with company not found
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
        ?bool $submitInvestigationWhenNotIdentified = null,
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
                'submitInvestigationWhenNotIdentified' => $submitInvestigationWhenNotIdentified,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($portfolioID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### Portfolio Companies
     *
     * Manage companies within a specific portfolio. - **GET**: List all companies
     * currently in the portfolio. - **POST**: Register and add a new company to the
     * portfolio.
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
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
     * ### Remove Portfolio Company
     *
     * Remove a company from a portfolio using its internal `external_id`.
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
