<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type WebhookSubscriptionShape from \Businessradar\Webhooks\WebhookSubscription
 *
 * @phpstan-type WebhookShape = array{
 *   createdAt: \DateTimeInterface,
 *   externalID: string,
 *   subscriptions: list<WebhookSubscription|WebhookSubscriptionShape>,
 *   updatedAt: \DateTimeInterface,
 *   url: string,
 *   enabled?: bool|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('external_id')]
    public string $externalID;

    /** @var list<WebhookSubscription> $subscriptions */
    #[Required(list: WebhookSubscription::class)]
    public array $subscriptions;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Required]
    public string $url;

    #[Optional]
    public ?bool $enabled;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(
     *   createdAt: ..., externalID: ..., subscriptions: ..., updatedAt: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)
     *   ->withCreatedAt(...)
     *   ->withExternalID(...)
     *   ->withSubscriptions(...)
     *   ->withUpdatedAt(...)
     *   ->withURL(...)
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
     * @param list<WebhookSubscription|WebhookSubscriptionShape> $subscriptions
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $externalID,
        array $subscriptions,
        \DateTimeInterface $updatedAt,
        string $url,
        ?bool $enabled = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['externalID'] = $externalID;
        $self['subscriptions'] = $subscriptions;
        $self['updatedAt'] = $updatedAt;
        $self['url'] = $url;

        null !== $enabled && $self['enabled'] = $enabled;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * @param list<WebhookSubscription|WebhookSubscriptionShape> $subscriptions
     */
    public function withSubscriptions(array $subscriptions): self
    {
        $self = clone $this;
        $self['subscriptions'] = $subscriptions;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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
