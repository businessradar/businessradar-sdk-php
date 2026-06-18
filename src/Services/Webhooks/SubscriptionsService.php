<?php

declare(strict_types=1);

namespace Businessradar\Services\Webhooks;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Webhooks\SubscriptionsContract;
use Businessradar\Webhooks\Subscriptions\SubscriptionCreateParams\EventType;
use Businessradar\Webhooks\WebhookSubscription;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class SubscriptionsService implements SubscriptionsContract
{
    /**
     * @api
     */
    public SubscriptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SubscriptionsRawService($client);
    }

    /**
     * @api
     *
     * List and add subscriptions on a specific webhook.
     *
     * @param EventType|value-of<EventType> $eventType * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
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
    ): WebhookSubscription {
        $params = Util::removeNulls(['eventType' => $eventType]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List and add subscriptions on a specific webhook.
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
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a single subscription from a webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $subscriptionExternalID,
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['webhookExternalID' => $webhookExternalID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($subscriptionExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
