<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListResultsParams\Order;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
use Businessradar\Compliance\ComplianceListResultsParams\Sorting;
use Businessradar\Compliance\ComplianceListResultsResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type EntityShape from \Businessradar\Compliance\ComplianceCreateParams\Entity
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ComplianceContract
{
    /**
     * @api
     *
     * @param bool $allEntitiesScreeningEnabled If enabled all found entities (UBOs, directors, shareholders) will be screened. This can have a high cost impact.
     * @param bool $directorsScreeningEnabled if directors should be screened
     * @param list<Entity|EntityShape> $entities
     * @param float|null $ownershipScreeningThreshold the threshold for ultimate ownership to enable for screening
     * @param bool $uboScreeningEnabled if enabled, UBOs discovered for the company will be screened
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        bool $allEntitiesScreeningEnabled = false,
        ?string $companyID = null,
        ?bool $directorsScreeningEnabled = null,
        ?array $entities = null,
        ?float $ownershipScreeningThreshold = null,
        bool $uboScreeningEnabled = false,
        RequestOptions|array|null $requestOptions = null,
    ): ComplianceNewResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): ComplianceGetResponse;

    /**
     * @api
     *
     * @param string $entity Filter by entity external ID
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
        ?float $minConfidence = null,
        ?string $nextKey = null,
        Order|string $order = 'desc',
        ResultType|string|null $resultType = null,
        Sorting|string $sorting = 'created_at',
        RequestOptions|array|null $requestOptions = null,
    ): NextKey;
}
