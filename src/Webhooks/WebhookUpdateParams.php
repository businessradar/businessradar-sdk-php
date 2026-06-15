<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Retrieve, update, or delete a single webhook.
 *
 * @see Businessradar\Services\WebhooksService::update()
 *
 * @phpstan-import-type WebhookSubscriptionRequestShape from \Businessradar\Webhooks\WebhookSubscriptionRequest
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   subscriptions: list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape>,
 *   url: string,
 *   enabled?: bool|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<WebhookSubscriptionRequest> $subscriptions */
    #[Required(list: WebhookSubscriptionRequest::class)]
    public array $subscriptions;

    #[Required]
    public string $url;

    #[Optional]
    public ?bool $enabled;

    /**
     * `new WebhookUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookUpdateParams::with(subscriptions: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookUpdateParams)->withSubscriptions(...)->withURL(...)
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
     * @param list<WebhookSubscriptionRequest|WebhookSubscriptionRequestShape> $subscriptions
     */
    public static function with(
        array $subscriptions,
        string $url,
        ?bool $enabled = null
    ): self {
        $self = new self;

        $self['subscriptions'] = $subscriptions;
        $self['url'] = $url;

        null !== $enabled && $self['enabled'] = $enabled;

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

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }
}
