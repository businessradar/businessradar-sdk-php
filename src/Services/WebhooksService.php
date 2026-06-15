<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\WebhooksContract;
use Businessradar\Services\Webhooks\DeliveriesService;
use Businessradar\Services\Webhooks\SubscriptionsService;
use Businessradar\Webhooks\Webhook;
use Businessradar\Webhooks\WebhookRegenerateSecretResponse;
use Businessradar\Webhooks\WebhookSubscriptionRequest;

/**
 * @phpstan-import-type WebhookSubscriptionRequestShape from \Businessradar\Webhooks\WebhookSubscriptionRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @api
     */
    public DeliveriesService $deliveries;

    /**
     * @api
     */
    public SubscriptionsService $subscriptions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
        $this->deliveries = new DeliveriesService($client);
        $this->subscriptions = new SubscriptionsService($client);
    }

    /**
     * @api
     *
     * List and create webhooks for the active profile.
     *
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape> $subscriptions
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $subscriptions,
        string $url,
        ?bool $enabled = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook {
        $params = Util::removeNulls(
            ['subscriptions' => $subscriptions, 'url' => $url, 'enabled' => $enabled]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): Webhook {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($webhookExternalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape> $subscriptions
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $webhookExternalID,
        array $subscriptions,
        string $url,
        ?bool $enabled = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook {
        $params = Util::removeNulls(
            ['subscriptions' => $subscriptions, 'url' => $url, 'enabled' => $enabled]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List and create webhooks for the active profile.
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<Webhook>
     *
     * @throws APIException
     */
    public function list(
        ?string $nextKey = null,
        RequestOptions|array|null $requestOptions = null
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($webhookExternalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape> $subscriptions
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function partialUpdate(
        string $webhookExternalID,
        ?bool $enabled = null,
        ?array $subscriptions = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook {
        $params = Util::removeNulls(
            ['enabled' => $enabled, 'subscriptions' => $subscriptions, 'url' => $url]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->partialUpdate($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Rotate the secret. The new value is returned once and never shown again.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function regenerateSecret(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookRegenerateSecretResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->regenerateSecret($webhookExternalID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Return all available webhook event types.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveEventTypes(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveEventTypes(requestOptions: $requestOptions);

        return $response->parse();
    }
}
