<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ComplianceContract
{
    /**
     * @api
     *
     * @param bool $allEntitiesScreeningEnabled If enabled all found entities UBOs, directors, shareholders will be screened. This can have an high cost impact.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $companyID,
        bool $allEntitiesScreeningEnabled = false,
        bool $directorsScreeningEnabled = true,
        float $ownershipScreeningThreshold = 0.7,
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
