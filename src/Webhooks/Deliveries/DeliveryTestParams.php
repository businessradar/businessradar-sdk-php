<?php

declare(strict_types=1);

namespace Businessradar\Webhooks\Deliveries;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\Webhooks\Deliveries\DeliveryTestParams\EventType;

/**
 * Queue a synthetic test event by creating a pending WebhookDelivery.
 *
 * @see Businessradar\Services\Webhooks\DeliveriesService::test()
 *
 * @phpstan-type DeliveryTestParamsShape = array{
 *   eventType?: null|EventType|value-of<EventType>
 * }
 */
final class DeliveryTestParams implements BaseModel
{
    /** @use SdkModel<DeliveryTestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered.
     *
     * @var value-of<EventType>|null $eventType
     */
    #[Optional('event_type', enum: EventType::class)]
    public ?string $eventType;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param EventType|value-of<EventType>|null $eventType
     */
    public static function with(EventType|string|null $eventType = null): self
    {
        $self = new self;

        null !== $eventType && $self['eventType'] = $eventType;

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
