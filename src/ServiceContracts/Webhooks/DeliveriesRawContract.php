<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Webhooks;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Deliveries\DeliveryListParams;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams;
use Businessradar\Webhooks\WebhookDelivery;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface DeliveriesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<WebhookDelivery>>
     *
     * @throws APIException
     */
    public function list(
        string $webhookExternalID,
        array|DeliveryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeliveryTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookDelivery>
     *
     * @throws APIException
     */
    public function test(
        string $webhookExternalID,
        array|DeliveryTestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
