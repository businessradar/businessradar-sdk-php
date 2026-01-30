<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\Portfolios\Portfolio;
use Businessradar\Portfolios\PortfolioCreateParams\DefaultPermission;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface PortfoliosContract
{
    /**
     * @api
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
    ): Portfolio;

    /**
     * @api
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<Portfolio>
     *
     * @throws APIException
     */
    public function list(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey;
}
