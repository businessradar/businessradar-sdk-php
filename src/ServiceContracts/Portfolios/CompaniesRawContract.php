<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Portfolios;

use Businessradar\Companies\Registration;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\Portfolios\Companies\CompanyCreateParams;
use Businessradar\Portfolios\Companies\CompanyDeleteParams;
use Businessradar\Portfolios\Companies\CompanyListParams;
use Businessradar\Portfolios\Companies\CompanyListResponse;
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
        string $portfolioID,
        array|CompanyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
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
        string $portfolioID,
        array|CompanyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CompanyDeleteParams $params
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
    ): BaseResponse;
}
