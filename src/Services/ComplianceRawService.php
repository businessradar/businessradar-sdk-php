<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceCreateParams;
use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListResultsParams;
use Businessradar\Compliance\ComplianceListResultsParams\Order;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
use Businessradar\Compliance\ComplianceListResultsParams\Sorting;
use Businessradar\Compliance\ComplianceListResultsResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\ComplianceRawContract;

/**
 * @phpstan-import-type EntityShape from \Businessradar\Compliance\ComplianceCreateParams\Entity
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
     *   allEntitiesScreeningEnabled?: bool,
     *   companyID?: string|null,
     *   directorsScreeningEnabled?: bool,
     *   entities?: list<Entity|EntityShape>,
     *   ownershipScreeningThreshold?: float|null,
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
     * Get compliance check details.
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

    /**
     * @api
     *
     * List compliance results.
     *
     * @param array{
     *   entity?: string,
     *   minConfidence?: float,
     *   nextKey?: string,
     *   order?: Order|value-of<Order>,
     *   resultType?: ResultType|value-of<ResultType>,
     *   sorting?: Sorting|value-of<Sorting>,
     * }|ComplianceListResultsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ComplianceListResultsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/compliance/%1$s/results', $externalID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'minConfidence' => 'min_confidence',
                    'nextKey' => 'next_key',
                    'resultType' => 'result_type',
                ],
            ),
            options: $options,
            convert: ComplianceListResultsResponse::class,
            page: NextKey::class,
        );
    }
}
