<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Webhooks;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Subscriptions\SubscriptionCreateParams;
use Businessradar\Webhooks\Subscriptions\SubscriptionDeleteParams;
use Businessradar\Webhooks\Subscriptions\SubscriptionListParams;
use Businessradar\Webhooks\WebhookSubscription;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface SubscriptionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionListParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SubscriptionDeleteParams $params
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
    ): BaseResponse;
}
