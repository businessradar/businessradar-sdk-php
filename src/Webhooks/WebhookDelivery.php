<?php

declare(strict_types=1);

namespace Businessradar\Webhooks;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookDeliveryShape = array{
 *   attemptCount: int,
 *   createdAt: \DateTimeInterface,
 *   data: mixed,
 *   errorDetails: string|null,
 *   externalID: string,
 *   status: WebhookDeliveryStatusEnum|value-of<WebhookDeliveryStatusEnum>,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class WebhookDelivery implements BaseModel
{
    /** @use SdkModel<WebhookDeliveryShape> */
    use SdkModel;

    #[Required('attempt_count')]
    public int $attemptCount;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public mixed $data;

    #[Required('error_details')]
    public ?string $errorDetails;

    #[Required('external_id')]
    public string $externalID;

    /**
     * * `pending` - Pending
     * * `in_progress` - In Progress
     * * `completed` - Completed
     * * `failed` - Failed.
     *
     * @var value-of<WebhookDeliveryStatusEnum> $status
     */
    #[Required(enum: WebhookDeliveryStatusEnum::class)]
    public string $status;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * `new WebhookDelivery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookDelivery::with(
     *   attemptCount: ...,
     *   createdAt: ...,
     *   data: ...,
     *   errorDetails: ...,
     *   externalID: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookDelivery)
     *   ->withAttemptCount(...)
     *   ->withCreatedAt(...)
     *   ->withData(...)
     *   ->withErrorDetails(...)
     *   ->withExternalID(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
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
     * @param WebhookDeliveryStatusEnum|value-of<WebhookDeliveryStatusEnum> $status
     */
    public static function with(
        int $attemptCount,
        \DateTimeInterface $createdAt,
        mixed $data,
        ?string $errorDetails,
        string $externalID,
        WebhookDeliveryStatusEnum|string $status,
        \DateTimeInterface $updatedAt,
    ): self {
        $self = new self;

        $self['attemptCount'] = $attemptCount;
        $self['createdAt'] = $createdAt;
        $self['data'] = $data;
        $self['errorDetails'] = $errorDetails;
        $self['externalID'] = $externalID;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withAttemptCount(int $attemptCount): self
    {
        $self = clone $this;
        $self['attemptCount'] = $attemptCount;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withErrorDetails(?string $errorDetails): self
    {
        $self = clone $this;
        $self['errorDetails'] = $errorDetails;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * * `pending` - Pending
     * * `in_progress` - In Progress
     * * `completed` - Completed
     * * `failed` - Failed.
     *
     * @param WebhookDeliveryStatusEnum|value-of<WebhookDeliveryStatusEnum> $status
     */
    public function withStatus(WebhookDeliveryStatusEnum|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
