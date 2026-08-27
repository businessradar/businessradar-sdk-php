<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceListParams\ComplianceScore;
use Businessradar\Compliance\ComplianceListParams\Order;
use Businessradar\Compliance\ComplianceListParams\Sorting;
use Businessradar\Compliance\ComplianceListParams\Status;
use Businessradar\Compliance\ComplianceListResponse;
use Businessradar\Compliance\ComplianceListResultsParams\ResultType;
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
     * @param bool $adverseMediaMonitoringEnabled Deprecated: monitoring is now derived from screening. This flag (OR'd with sanction_monitoring_enabled) sets the check's monitoring master switch; per-type coverage follows which screenings run.
     * @param bool $directorsScreeningEnabled if directors should be screened
     * @param list<Entity|EntityShape> $entities
     * @param string|null $name custom name for this compliance check
     * @param float|null $ownershipScreeningThreshold the threshold for ultimate ownership to enable for screening
     * @param bool $sanctionMonitoringEnabled Deprecated: monitoring is now derived from screening. This flag (OR'd with adverse_media_monitoring_enabled) sets the check's monitoring master switch; per-type coverage follows which screenings run.
     * @param bool $uboScreeningEnabled if enabled, UBOs discovered for the company will be screened
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        bool $adverseMediaMonitoringEnabled = false,
        ?string $companyID = null,
        ?bool $directorsScreeningEnabled = null,
        ?array $entities = null,
        ?string $name = null,
        ?float $ownershipScreeningThreshold = null,
        bool $sanctionMonitoringEnabled = false,
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
     * @param bool $adverseMediaMonitoringEnabled filter checks that have entities with adverse media monitoring enabled (pending or active)
     * @param ComplianceScore|value-of<ComplianceScore> $complianceScore filter by compliance score
     * @param \DateTimeInterface $createdAtGte filter checks created at or after this time
     * @param \DateTimeInterface $createdAtLte filter checks created at or before this time
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param Order|value-of<Order> $order sorting order
     * @param \DateTimeInterface $resultsChangedAtGte filter checks with results changed at or after this time
     * @param \DateTimeInterface $resultsChangedAtLte filter checks with results changed at or before this time
     * @param bool $sanctionMonitoringEnabled filter checks that have entities with sanction monitoring enabled (pending or active)
     * @param Sorting|value-of<Sorting> $sorting sorting field
     * @param Status|value-of<Status> $status filter by compliance check status
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<ComplianceListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?bool $adverseMediaMonitoringEnabled = null,
        ComplianceScore|string|null $complianceScore = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $nextKey = null,
        Order|string $order = 'desc',
        ?\DateTimeInterface $resultsChangedAtGte = null,
        ?\DateTimeInterface $resultsChangedAtLte = null,
        ?bool $sanctionMonitoringEnabled = null,
        Sorting|string $sorting = 'created_at',
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): NextKey;

    /**
     * @api
     *
     * @param string $entity Filter by entity external ID
     * @param bool $excludeAutomatedFalsePositives Filter out automated false positive rated results. While a check is still running, only AI-validated results are returned, so the result count grows monotonically. Set to `false` to get the raw unfiltered set, including results that have not been validated yet.
     * @param float $minConfidence Filter by minimum confidence score (0.0 - 1.0)
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param \Businessradar\Compliance\ComplianceListResultsParams\Order|value-of<\Businessradar\Compliance\ComplianceListResultsParams\Order> $order Sorting order
     * @param ResultType|value-of<ResultType> $resultType Filter by result type
     * @param \Businessradar\Compliance\ComplianceListResultsParams\Sorting|value-of<\Businessradar\Compliance\ComplianceListResultsParams\Sorting> $sorting Sorting field
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
        \Businessradar\Compliance\ComplianceListResultsParams\Order|string $order = 'desc',
        ResultType|string|null $resultType = null,
        \Businessradar\Compliance\ComplianceListResultsParams\Sorting|string $sorting = 'created_at',
        RequestOptions|array|null $requestOptions = null,
    ): NextKey;
}
