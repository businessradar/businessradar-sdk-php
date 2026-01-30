<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Compliance\ComplianceCreateParams;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListResultsParams;
use Businessradar\Compliance\ComplianceListResultsResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ComplianceRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ComplianceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ComplianceNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ComplianceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ComplianceGetResponse>
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
     * @param array<string,mixed>|ComplianceListResultsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<ComplianceListResultsResponse>>
     *
     * @throws APIException
     */
    public function listResults(
        string $externalID,
        array|ComplianceListResultsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
