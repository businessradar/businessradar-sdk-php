<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookRegenerateSecretResponseShape = array{secret: string}
 */
final class WebhookRegenerateSecretResponse implements BaseModel
{
    /** @use SdkModel<WebhookRegenerateSecretResponseShape> */
    use SdkModel;

    #[Required]
    public string $secret;

    /**
     * `new WebhookRegenerateSecretResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookRegenerateSecretResponse::with(secret: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookRegenerateSecretResponse)->withSecret(...)
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
    public static function with(string $secret): self
    {
        $self = new self;

        $self['secret'] = $secret;

        return $self;
    }

    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }
}
