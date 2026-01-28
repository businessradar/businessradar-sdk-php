<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Companies\CompanyCreateParams;
use Businessradar\Companies\CompanyGetResponse;
use Businessradar\Companies\CompanyListAttributeChangesParams;
use Businessradar\Companies\CompanyListAttributeChangesResponse;
use Businessradar\Companies\CompanyListParams;
use Businessradar\Companies\CompanyListResponse;
use Businessradar\Companies\Registration;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface CompaniesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CompanyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Registration>
     *
     * @throws APIException
     */
    public function create(
        array|CompanyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CompanyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|CompanyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CompanyListAttributeChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<CompanyListAttributeChangesResponse>>
     *
     * @throws APIException
     */
    public function listAttributeChanges(
        array|CompanyListAttributeChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
