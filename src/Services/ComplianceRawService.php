<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceCreateParams;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\ComplianceRawContract;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ComplianceRawService implements ComplianceRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new compliance check.
     *
     * @param array{
     *   companyID: string,
     *   allEntitiesScreeningEnabled?: bool,
     *   directorsScreeningEnabled?: bool,
     *   ownershipScreeningThreshold?: float,
     * }|ComplianceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ComplianceNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ComplianceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ComplianceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/compliance',
            body: (object) $parsed,
            options: $options,
            convert: ComplianceNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Get compliance check results.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/compliance/%1$s', $externalID],
            options: $requestOptions,
            convert: ComplianceGetResponse::class,
        );
    }
}
