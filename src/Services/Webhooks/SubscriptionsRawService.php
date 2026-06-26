<?php

declare(strict_types=1);

namespace Businessradar\Services\Webhooks;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Webhooks\SubscriptionsRawContract;
use Businessradar\Webhooks\Subscriptions\SubscriptionCreateParams;
use Businessradar\Webhooks\Subscriptions\SubscriptionCreateParams\EventType;
use Businessradar\Webhooks\Subscriptions\SubscriptionDeleteParams;
use Businessradar\Webhooks\Subscriptions\SubscriptionListParams;
use Businessradar\Webhooks\WebhookSubscription;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class SubscriptionsRawService implements SubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List and add subscriptions on a specific webhook.
     *
     * @param array{
     *   eventType: value-of<EventType>, portfolio?: string|null
     * }|SubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookSubscription>
     *
     * @throws APIException
     */
    public function create(
        string $webhookExternalID,
        array|SubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ext/v3/webhooks/%1$s/subscriptions/', $webhookExternalID],
            body: (object) $parsed,
            options: $options,
            convert: WebhookSubscription::class,
        );
    }

    /**
     * @api
     *
     * List and add subscriptions on a specific webhook.
     *
     * @param array{nextKey?: string}|SubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<WebhookSubscription>>
     *
     * @throws APIException
     */
    public function list(
        string $webhookExternalID,
        array|SubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/webhooks/%1$s/subscriptions/', $webhookExternalID],
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: WebhookSubscription::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * Remove a single subscription from a webhook.
     *
     * @param array{webhookExternalID: string}|SubscriptionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionExternalID,
        array|SubscriptionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubscriptionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $webhookExternalID = $parsed['webhookExternalID'];
        unset($parsed['webhookExternalID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'ext/v3/webhooks/%1$s/subscriptions/%2$s/',
                $webhookExternalID,
                $subscriptionExternalID,
            ],
            options: $options,
            convert: null,
        );
    }
}
