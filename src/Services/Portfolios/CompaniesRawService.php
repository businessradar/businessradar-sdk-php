<?php

declare(strict_types=1);

namespace Businessradar\Services\Portfolios;

use Businessradar\Client;
use Businessradar\Companies\Registration;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\Portfolios\Companies\CompanyCreateParams;
use Businessradar\Portfolios\Companies\CompanyCreateParams\Country;
use Businessradar\Portfolios\Companies\CompanyDeleteParams;
use Businessradar\Portfolios\Companies\CompanyListParams;
use Businessradar\Portfolios\Companies\CompanyListResponse;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Portfolios\CompaniesRawContract;

/**
 * @phpstan-import-type PortfolioCompanyDetailRequestShape from \Businessradar\PortfolioCompanyDetailRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class CompaniesRawService implements CompaniesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{
     *   company?: PortfolioCompanyDetailRequest|PortfolioCompanyDetailRequestShape|null,
     *   country?: value-of<Country>,
     *   customerReference?: string|null,
     *   dunsNumber?: string|null,
     *   primaryName?: string|null,
     *   registrationNumber?: string|null,
     * }|CompanyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Registration>
     *
     * @throws APIException
     */
    public function create(
        string $portfolioID,
        array|CompanyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ext/v3/portfolios/%1$s/companies', $portfolioID],
            body: (object) $parsed,
            options: $options,
            convert: Registration::class,
        );
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
     * @param array{nextKey?: string}|CompanyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListResponse>>
     *
     * @throws APIException
     */
    public function list(
        string $portfolioID,
        array|CompanyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/portfolios/%1$s/companies', $portfolioID],
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: CompanyListResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### Remove Portfolio Company
     *
     * Remove a company from a portfolio using its internal `external_id`.
     *
     * @param array{portfolioID: string}|CompanyDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $externalID,
        array|CompanyDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $portfolioID = $parsed['portfolioID'];
        unset($parsed['portfolioID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'ext/v3/portfolios/%1$s/companies/%2$s', $portfolioID, $externalID,
            ],
            options: $options,
            convert: null,
        );
    }
}
