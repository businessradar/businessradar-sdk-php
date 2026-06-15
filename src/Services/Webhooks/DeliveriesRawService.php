<?php

declare(strict_types=1);

namespace Businessradar\Services\Webhooks;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Webhooks\DeliveriesRawContract;
use Businessradar\Webhooks\Deliveries\DeliveryListParams;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams\EventType;
use Businessradar\Webhooks\WebhookDelivery;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class DeliveriesRawService implements DeliveriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List delivery history for a specific webhook.
     *
     * @param array{nextKey?: string}|DeliveryListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = DeliveryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/webhooks/%1$s/deliveries/', $webhookExternalID],
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: WebhookDelivery::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * Queue a synthetic test event by creating a pending WebhookDelivery.
     *
     * @param array{eventType?: value-of<EventType>}|DeliveryTestParams $params
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
    ): BaseResponse {
        [$parsed, $options] = DeliveryTestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ext/v3/webhooks/%1$s/deliveries/test/', $webhookExternalID],
            body: (object) $parsed,
            options: $options,
            convert: WebhookDelivery::class,
        );
    }
}
