<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\Webhooks\WebhookSubscriptionRequest\EventType;

/**
 * @phpstan-type WebhookSubscriptionRequestShape = array{
 *   eventType: EventType|value-of<EventType>
 * }
 */
final class WebhookSubscriptionRequest implements BaseModel
{
    /** @use SdkModel<WebhookSubscriptionRequestShape> */
    use SdkModel;

    /**
     * * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    /**
     * `new WebhookSubscriptionRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookSubscriptionRequest::with(eventType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookSubscriptionRequest)->withEventType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(EventType|string $eventType): self
    {
        $self = new self;

        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }
}
