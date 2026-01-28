<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\Portfolios\Portfolio;
use Businessradar\Portfolios\PortfolioCreateParams\DefaultPermission;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\PortfoliosContract;
use Businessradar\Services\Portfolios\CompaniesService;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class PortfoliosService implements PortfoliosContract
{
    /**
     * @api
     */
    public PortfoliosRawService $raw;

    /**
     * @api
     */
    public CompaniesService $companies;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PortfoliosRawService($client);
        $this->companies = new CompaniesService($client);
    }

    /**
     * @api
     *
     * List Create Portfolio.
     *
     * @param string|null $customerReference customer reference for the client to understand relationship
     * @param DefaultPermission|value-of<DefaultPermission>|null $defaultPermission Default permission for all users in organization.
     *
     * * `view_only` - Only Viewing Access
     * * `write` - View and Write Access
     * * `admin` - View, Write and Admin Access
     * * `owner` - Portfolio Owner
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $customerReference = null,
        DefaultPermission|string|null $defaultPermission = null,
        RequestOptions|array|null $requestOptions = null,
    ): Portfolio {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'customerReference' => $customerReference,
                'defaultPermission' => $defaultPermission,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Create Portfolio.
     *
     * @param string $nextKey the next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<Portfolio>
     *
     * @throws APIException
     */
    public function list(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
