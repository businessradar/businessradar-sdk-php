<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListResultsParams\Order;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
use Businessradar\Compliance\ComplianceListResultsParams\Sorting;
use Businessradar\Compliance\ComplianceListResultsResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\ComplianceContract;

/**
 * @phpstan-import-type EntityShape from \Businessradar\Compliance\ComplianceCreateParams\Entity
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class ComplianceService implements ComplianceContract
{
    /**
     * @api
     */
    public ComplianceRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ComplianceRawService($client);
    }

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
     * @param bool $directorsScreeningEnabled if directors should be screened
     * @param list<Entity|EntityShape> $entities
     * @param float|null $ownershipScreeningThreshold the threshold for ultimate ownership to enable for screening
     * @param bool $uboScreeningEnabled if enabled, UBOs discovered for the company will be screened
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $companyID = null,
        ?bool $directorsScreeningEnabled = null,
        ?array $entities = null,
        ?float $ownershipScreeningThreshold = null,
        bool $uboScreeningEnabled = false,
        RequestOptions|array|null $requestOptions = null,
    ): ComplianceNewResponse {
        $params = Util::removeNulls(
            [
                'companyID' => $companyID,
                'directorsScreeningEnabled' => $directorsScreeningEnabled,
                'entities' => $entities,
                'ownershipScreeningThreshold' => $ownershipScreeningThreshold,
                'uboScreeningEnabled' => $uboScreeningEnabled,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): ComplianceGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($externalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * ### List Compliance Results
     *
     * Retrieve all findings for a compliance check. Results can be filtered by entity,
     * type of finding (e.g., Sanction, PEP), and confidence score.
     *
     * @param string $entity Filter by entity external ID
     * @param bool $excludeAutomatedFalsePositives Filter out automated false positive rated results
     * @param float $minConfidence Filter by minimum confidence score (0.0 - 1.0)
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param Order|value-of<Order> $order Sorting order
     * @param ResultType|value-of<ResultType> $resultType Filter by result type
     * @param Sorting|value-of<Sorting> $sorting Sorting field
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<ComplianceListResultsResponse>
     *
     * @throws APIException
     */
    public function listResults(
        string $externalID,
        ?string $entity = null,
        bool $excludeAutomatedFalsePositives = true,
        ?float $minConfidence = null,
        ?string $nextKey = null,
        Order|string $order = 'desc',
        ResultType|string|null $resultType = null,
        Sorting|string $sorting = 'created_at',
        RequestOptions|array|null $requestOptions = null,
    ): NextKey {
        $params = Util::removeNulls(
            [
                'entity' => $entity,
                'excludeAutomatedFalsePositives' => $excludeAutomatedFalsePositives,
                'minConfidence' => $minConfidence,
                'nextKey' => $nextKey,
                'order' => $order,
                'resultType' => $resultType,
                'sorting' => $sorting,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listResults($externalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
