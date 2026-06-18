<?php

declare(strict_types=1);

namespace Businessradar\ServiceContracts\Webhooks;

use Businessradar\Core\Exceptions\APIException;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams\EventType;
use Businessradar\Webhooks\WebhookDelivery;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
interface DeliveriesContract
{
    /**
     * @api
     *
     * @param string $nextKey A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     * @param RequestOpts|null $requestOptions
     *
     * @return NextKey<WebhookDelivery>
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
     * @param EventType|value-of<EventType> $eventType * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $webhookExternalID,
        EventType|string|null $eventType = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookDelivery;
}
