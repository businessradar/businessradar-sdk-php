<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\Portfolios\Portfolio;
use Businessradar\Portfolios\PortfolioCreateParams;
use Businessradar\Portfolios\PortfolioListParams;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface PortfoliosRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PortfolioCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Portfolio>
     *
     * @throws APIException
     */
    public function create(
        array|PortfolioCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PortfolioListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Portfolio>>
     *
     * @throws APIException
     */
    public function list(
        array|PortfolioListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
