<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceCreateParams;
use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListParams;
use Businessradar\Compliance\ComplianceListParams\ComplianceScore;
use Businessradar\Compliance\ComplianceListParams\Order;
use Businessradar\Compliance\ComplianceListParams\Sorting;
use Businessradar\Compliance\ComplianceListParams\Status;
use Businessradar\Compliance\ComplianceListResponse;
use Businessradar\Compliance\ComplianceListResultsParams;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
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
     * ### Create Compliance Check (Asynchronous)
     *
     * Initiate a new compliance screening using one of two methods:
     *
     * 1. **Company-based screening**: Provide a `company_id` to screen the company.
     * Optionally enable screening of related entities (UBOs and directors) via
     * `ubo_screening_enabled` and `directors_screening_enabled`. You can optionally
     * include a list of additional `entities` to be screened alongside the company.
     *
     * 2. **Custom entity screening**: Provide a list of `entities` without a
     * `company_id` to screen specific individuals or organizations that are not
     * necessarily affiliated with a company in our database.
     *
     * Once posted, Business Radar processes the request in the background.
     *
     * To check the progress and/or retrieve the final result, you can use the [GET
     * /compliance/{external_id}](/ext/v3/#/ext/ext_v3_compliance_retrieve) endpoint.
     *
     * @param array{
     *   adverseMediaMonitoringEnabled?: bool,
     *   companyID?: string|null,
     *   directorsScreeningEnabled?: bool,
     *   entities?: list<Entity|EntityShape>,
     *   name?: string|null,
     *   ownershipScreeningThreshold?: float|null,
     *   sanctionMonitoringEnabled?: bool,
     *   uboScreeningEnabled?: bool,
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
     * ### Compliance Check Status
     *
     * Check the current status, progress, and high-level scores of a specific compliance
     * check.
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
     * ### Compliance Checks
     *
     * **GET** — Retrieve a paginated list of compliance checks created via this API key.
     * Supports filtering by status and date ranges, and sorting by key timestamps.
     *
     * **POST** — Initiate a new compliance screening using one of two methods:
     *
     * 1. **Company-based screening**: Provide a `company_id` to screen the company.
     * Optionally enable screening of related entities (UBOs and directors) via
     * `ubo_screening_enabled` and `directors_screening_enabled`. You can also include
     * additional custom `entities` to be screened alongside the company.
     *
     * 2. **Custom entity screening**: Provide a list of `entities` without a `company_id`
     * to screen specific individuals or organizations that are not necessarily affiliated
     * with a company in our database.
     *
     * @param array{
     *   adverseMediaMonitoringEnabled?: bool,
     *   complianceScore?: ComplianceScore|value-of<ComplianceScore>,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   nextKey?: string,
     *   order?: Order|value-of<Order>,
     *   resultsChangedAtGte?: \DateTimeInterface,
     *   resultsChangedAtLte?: \DateTimeInterface,
     *   sanctionMonitoringEnabled?: bool,
     *   sorting?: Sorting|value-of<Sorting>,
     *   status?: Status|value-of<Status>,
     * }|ComplianceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<ComplianceListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ComplianceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ComplianceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/compliance',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'adverseMediaMonitoringEnabled' => 'adverse_media_monitoring_enabled',
                    'complianceScore' => 'compliance_score',
                    'createdAtGte' => 'created_at__gte',
                    'createdAtLte' => 'created_at__lte',
                    'nextKey' => 'next_key',
                    'resultsChangedAtGte' => 'results_changed_at__gte',
                    'resultsChangedAtLte' => 'results_changed_at__lte',
                    'sanctionMonitoringEnabled' => 'sanction_monitoring_enabled',
                ],
            ),
            options: $options,
            convert: ComplianceListResponse::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * ### List Compliance Results
     *
     * Retrieve all findings for a compliance check. Results can be filtered by entity,
     * type of finding (e.g., Sanction, PEP), and confidence score.
     *
     * @param array{
     *   entity?: string,
     *   excludeAutomatedFalsePositives?: bool,
     *   minConfidence?: float,
     *   nextKey?: string,
     *   order?: ComplianceListResultsParams\Order|value-of<ComplianceListResultsParams\Order>,
     *   resultType?: ResultType|value-of<ResultType>,
     *   sorting?: ComplianceListResultsParams\Sorting|value-of<ComplianceListResultsParams\Sorting>,
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
                    'excludeAutomatedFalsePositives' => 'exclude_automated_false_positives',
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
