<?php

declare(strict_types=1);

namespace Businessradar\Services;

use Businessradar\Client;
use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\WebhooksRawContract;
use Businessradar\Webhooks\Webhook;
use Businessradar\Webhooks\WebhookCreateParams;
use Businessradar\Webhooks\WebhookListParams;
use Businessradar\Webhooks\WebhookPartialUpdateParams;
use Businessradar\Webhooks\WebhookRegenerateSecretResponse;
use Businessradar\Webhooks\WebhookSubscriptionRequest;
use Businessradar\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type WebhookSubscriptionRequestShape from \Businessradar\Webhooks\WebhookSubscriptionRequest
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List and create webhooks for the active profile.
     *
     * @param array{
     *   subscriptions: list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>,
     *   url: string,
     *   enabled?: bool,
     * }|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'ext/v3/webhooks/',
            body: (object) $parsed,
            options: $options,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ext/v3/webhooks/%1$s/', $webhookExternalID],
            options: $requestOptions,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param array{
     *   subscriptions: list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>,
     *   url: string,
     *   enabled?: bool,
     * }|WebhookUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function update(
        string $webhookExternalID,
        array|WebhookUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['ext/v3/webhooks/%1$s/', $webhookExternalID],
            body: (object) $parsed,
            options: $options,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * List and create webhooks for the active profile.
     *
     * @param array{nextKey?: string}|WebhookListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Webhook>>
     *
     * @throws APIException
     */
    public function list(
        array|WebhookListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/webhooks/',
            query: Util::array_transform_keys($parsed, ['nextKey' => 'next_key']),
            options: $options,
            convert: Webhook::class,
            page: NextKey::class,
        );
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['ext/v3/webhooks/%1$s/', $webhookExternalID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Retrieve, update, or delete a single webhook.
     *
     * @param array{
     *   enabled?: bool,
     *   subscriptions?: list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>,
     *   url?: string,
     * }|WebhookPartialUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function partialUpdate(
        string $webhookExternalID,
        array|WebhookPartialUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookPartialUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['ext/v3/webhooks/%1$s/', $webhookExternalID],
            body: (object) $parsed,
            options: $options,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * Rotate the secret. The new value is returned once and never shown again.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookRegenerateSecretResponse>
     *
     * @throws APIException
     */
    public function regenerateSecret(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['ext/v3/webhooks/%1$s/regenerate_secret/', $webhookExternalID],
            options: $requestOptions,
            convert: WebhookRegenerateSecretResponse::class,
        );
    }

    /**
     * @api
     *
     * Return all available webhook event types.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveEventTypes(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ext/v3/webhooks/event_types/',
            options: $requestOptions,
            convert: null,
        );
    }
}
