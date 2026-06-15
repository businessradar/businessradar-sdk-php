<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts;

use Businessradar\Core\Contracts\BaseResponse;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Webhook;
use Businessradar\Webhooks\WebhookCreateParams;
use Businessradar\Webhooks\WebhookListParams;
use Businessradar\Webhooks\WebhookPartialUpdateParams;
use Businessradar\Webhooks\WebhookRegenerateSecretResponse;
use Businessradar\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebhookUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebhookListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NextKey<Webhook>>
     *
     * @throws APIException
     */
    public function list(
        array|WebhookListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebhookPartialUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookRegenerateSecretResponse>
     *
     * @throws APIException
     */
    public function regenerateSecret(
        string $webhookExternalID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieveEventTypes(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
