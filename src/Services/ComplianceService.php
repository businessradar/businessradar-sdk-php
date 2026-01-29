<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Compliance\ComplianceCreateParams\Entity;
use Businessradar\Compliance\ComplianceGetResponse;
use Businessradar\Compliance\ComplianceNewResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
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
     * Create a new compliance check.
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
    ): ComplianceNewResponse {
        $params = Util::removeNulls(
            [
                'allEntitiesScreeningEnabled' => $allEntitiesScreeningEnabled,
                'companyID' => $companyID,
                'directorsScreeningEnabled' => $directorsScreeningEnabled,
                'entities' => $entities,
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
     * Get compliance check details.
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
