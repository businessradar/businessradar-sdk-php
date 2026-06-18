<?php

declare(strict_types=1);

namespace Businessradar\Services\Webhooks;

use Businessradar\Client;
use Businessradar\Core\Exceptions\APIException;
use Businessradar\Core\Util;
use Businessradar\NextKey;
use Businessradar\RequestOptions;
use Businessradar\ServiceContracts\Webhooks\DeliveriesContract;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams\EventType;
use Businessradar\Webhooks\WebhookDelivery;

/**
 * @phpstan-import-type RequestOpts from \Businessradar\RequestOptions
 */
final class DeliveriesService implements DeliveriesContract
{
    /**
     * @api
     */
    public DeliveriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeliveriesRawService($client);
    }

    /**
     * @api
     *
     * List deliveries newest first.
     *
     * The default cursor pagination ignores the queryset ordering and applies
     * its own ``ordering`` attribute, so set it on the paginator here. The
     * ``-id`` tiebreaker keeps cursor paging stable when deliveries share a
     * ``created_at`` timestamp.
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
    ): NextKey {
        $params = Util::removeNulls(['nextKey' => $nextKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Queue a synthetic test event by creating a pending WebhookDelivery.
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
    ): WebhookDelivery {
        $params = Util::removeNulls(['eventType' => $eventType]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test($webhookExternalID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
