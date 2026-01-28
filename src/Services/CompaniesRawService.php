<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Companies\CompanyCreateParams;
use Businessradar\Companies\CompanyCreateParams\Country;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesParams;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListParams;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\Registration;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\PortfolioCompanyDetailRequest;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\CompaniesRawContract;

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
     * Register new Company to Business Radar.
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
            path: 'ext/v3/companies',
            body: (object) $parsed,
            options: $options,
            convert: Registration::class,
        );
    }

    /**
     * @api
     *
     * Get Company Information.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CompanyGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/companies/%1$s', $externalID],
            options: $requestOptions,
            convert: CompanyGetResponse::class,
        );
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
     * @param array{
     *   country?: list<string>,
     *   dunsNumber?: list<string>,
     *   nextKey?: string,
     *   portfolioID?: list<string>,
     *   query?: string,
     *   registrationNumber?: list<string>,
     *   websiteURL?: string,
     * }|CompanyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListResponse>>
     *
     * @throws APIException
     */
    public function list(
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
            path: 'ext/v3/companies',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'dunsNumber' => 'duns_number',
                    'nextKey' => 'next_key',
                    'portfolioID' => 'portfolio_id',
                    'registrationNumber' => 'registration_number',
                    'websiteURL' => 'website_url',
                ],
            ),
            options: $options,
            convert: CompanyListResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * List Company Updates.
     *
     * @param array{
     *   maxCreatedAt?: \DateTimeInterface,
     *   minCreatedAt?: \DateTimeInterface,
     *   nextKey?: string,
     * }|CompanyListAttributeChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListAttributeChangesResponse>>
     *
     * @throws APIException
     */
    public function listAttributeChanges(
        array|CompanyListAttributeChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CompanyListAttributeChangesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/companies/attribute_changes',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'maxCreatedAt' => 'max_created_at',
                    'minCreatedAt' => 'min_created_at',
                    'nextKey' => 'next_key',
                ],
            ),
            options: $options,
            convert: CompanyListAttributeChangesResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * Get Registration Information.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Registration>
     *
     * @throws APIException
     */
    public function retrieveRegistration(
        string $registrationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/registrations/%1$s', $registrationID],
            options: $requestOptions,
            convert: Registration::class,
        );
    }
}
