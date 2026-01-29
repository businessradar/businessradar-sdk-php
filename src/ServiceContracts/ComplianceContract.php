<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
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
     * @param bool $allEntitiesScreeningEnabled If enabled all found entities UBOs, directors, shareholders will be screened. This can have an high cost impact.
     * @param bool $directorsScreeningEnabled if directors should be screened
     * @param list<Entity|EntityShape> $entities
     * @param float|null $ownershipScreeningThreshold the threshold for ultimate ownership to enable for screening
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
}
