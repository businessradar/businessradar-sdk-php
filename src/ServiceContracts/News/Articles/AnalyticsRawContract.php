<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News\Articles;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateResponseItem;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface AnalyticsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AnalyticsGetCountByDateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<AnalyticsGetCountByDateResponseItem>>
     *
     * @throws APIException
     */
    public function getCountByDate(
        array|AnalyticsGetCountByDateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
