<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\News\Articles;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\News\Articles\Export\ArticleExport;
use Businessradar\News\Articles\Export\ExportCreateParams;
use Businessradar\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface ExportRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleExport>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ArticleExport>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
