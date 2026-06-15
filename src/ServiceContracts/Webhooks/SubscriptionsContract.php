<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Webhooks;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Subscriptions\SubscriptionCreateParams\EventType;
use Businessradar\Webhooks\WebhookSubscription;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface SubscriptionsContract
{
    /**
     * @api
     *
     * @param EventType|value-of<EventType> $eventType * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $webhookExternalID,
        EventType|string $eventType,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookSubscription;

    /**
     * @api
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<WebhookSubscription>
     *
     * @throws APIException
     */
    public function list(
        string $webhookExternalID,
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): NextKey;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionExternalID,
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
