<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Webhook;
use Businessradar\Webhooks\WebhookRegenerateSecretResponse;
use Businessradar\Webhooks\WebhookSubscriptionRequest;

/**
 * @phpstan-import-type WebhookSubscriptionRequestShape from \Businessradar\Webhooks\WebhookSubscriptionRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
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
    ): Webhook;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook;

    /**
     * @api
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
    ): Webhook;

    /**
     * @api
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
    ): NextKey;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
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
    ): Webhook;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function regenerateSecret(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookRegenerateSecretResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveEventTypes(
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
