<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\Webhooks\WebhookSubscription\EventType;

/**
 * @phpstan-type WebhookSubscriptionShape = array{
 *   eventType: EventType|value-of<EventType>,
 *   externalID: string,
 *   portfolio?: string|null,
 * }
 */
final class WebhookSubscription implements BaseModel
{
    /** @use SdkModel<WebhookSubscriptionShape> */
    use SdkModel;

    /**
     * * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered
     * * `company.updated` - Company Updated.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    #[Required('external_id')]
    public string $externalID;

    /**
     * Portfolio external_id. Required for portfolio-scoped events (e.g. company.updated); must be omitted for all other events.
     */
    #[Optional(nullable: true)]
    public ?string $portfolio;

    /**
     * `new WebhookSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookSubscription::with(eventType: ..., externalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookSubscription)->withEventType(...)->withExternalID(...)
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
    public static function with(
        EventType|string $eventType,
        string $externalID,
        ?string $portfolio = null
    ): self {
        $self = new self;

        $self['eventType'] = $eventType;
        $self['externalID'] = $externalID;

        null !== $portfolio && $self['portfolio'] = $portfolio;

        return $self;
    }

    /**
     * * `compliance_check.status_changed` - Compliance Check Status Changed
     * * `compliance_check.status_completed` - Compliance Check Status Completed
     * * `compliance_check.results.new` - Compliance Check Results New
     * * `company_registration.status_changed` - Company Registration Status Changed
     * * `company_registration.status_registered` - Company Registration Status Registered
     * * `company.updated` - Company Updated.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * Portfolio external_id. Required for portfolio-scoped events (e.g. company.updated); must be omitted for all other events.
     */
    public function withPortfolio(?string $portfolio): self
    {
        $self = clone $this;
        $self['portfolio'] = $portfolio;

        return $self;
    }
}
