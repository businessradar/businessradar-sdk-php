<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\ComplianceContract;

/**
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
     * Create a new compliance check.
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
    ): ComplianceNewResponse {
        $params = Util::removeNulls(
            [
                'companyID' => $companyID,
                'allEntitiesScreeningEnabled' => $allEntitiesScreeningEnabled,
                'directorsScreeningEnabled' => $directorsScreeningEnabled,
                'ownershipScreeningThreshold' => $ownershipScreeningThreshold,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get compliance check results.
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
}
