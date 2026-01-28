<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\Portfolios\Portfolio;
use Businessradar\Portfolios\PortfolioCreateParams;
use Businessradar\Portfolios\PortfolioCreateParams\DefaultPermission;
use Businessradar\Portfolios\PortfolioListParams;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\PortfoliosRawContract;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class PortfoliosRawService implements PortfoliosRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List Create Portfolio.
     *
     * @param array{
     *   name: string,
     *   customerReference?: string|null,
     *   defaultPermission?: DefaultPermission|value-of<DefaultPermission>|null,
     * }|PortfolioCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Portfolio>
     *
     * @throws APIException
     */
    public function create(
        array|PortfolioCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PortfolioCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/portfolios',
            body: (object) $parsed,
            options: $options,
            convert: Portfolio::class,
        );
    }

    /**
     * @api
     *
     * List Create Portfolio.
     *
     * @param array{nextKey?: string}|PortfolioListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Portfolio>>
     *
     * @throws APIException
     */
    public function list(
        array|PortfolioListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PortfolioListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/portfolios',
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: Portfolio::class,
            page: NextKey::class,
        );
    }
}
