<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Retrieve, update, or delete a single webhook.
 *
 * @see Businessradar\Services\WebhooksService::partialUpdate()
 *
 * @phpstan-import-type WebhookSubscriptionRequestShape from \Businessradar\Webhooks\WebhookSubscriptionRequest
 *
 * @phpstan-type WebhookPartialUpdateParamsShape = array{
 *   enabled?: bool|null,
 *   subscriptions?: list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>|null,
 *   url?: string|null,
 * }
 */
final class WebhookPartialUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookPartialUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?bool $enabled;

    /** @var list<WebhookSubscriptionRequest>|null $subscriptions */
    #[Optional(list: WebhookSubscriptionRequest::class)]
    public ?array $subscriptions;

    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>|null $subscriptions
     */
    public static function with(
        ?bool $enabled = null,
        ?array $subscriptions = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $subscriptions && $self['subscriptions'] = $subscriptions;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape> $subscriptions
     */
    public function withSubscriptions(array $subscriptions): self
    {
        $self = clone $this;
        $self['subscriptions'] = $subscriptions;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
