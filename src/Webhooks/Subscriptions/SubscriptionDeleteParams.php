<?php

declare(strict_types=1);

namespace Businessradar\Webhooks\Subscriptions;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Remove a single subscription from a webhook.
 *
 * @see Businessradar\Services\Webhooks\SubscriptionsService::delete()
 *
 * @phpstan-type SubscriptionDeleteParamsShape = array{webhookExternalID: string}
 */
final class SubscriptionDeleteParams implements BaseModel
{
    /** @use SdkModel<SubscriptionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $webhookExternalID;

    /**
     * `new SubscriptionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionDeleteParams::with(webhookExternalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionDeleteParams)->withWebhookExternalID(...)
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
     */
    public static function with(string $webhookExternalID): self
    {
        $self = new self;

        $self['webhookExternalID'] = $webhookExternalID;

        return $self;
    }

    public function withWebhookExternalID(string $webhookExternalID): self
    {
        $self = clone $this;
        $self['webhookExternalID'] = $webhookExternalID;

        return $self;
    }
}
