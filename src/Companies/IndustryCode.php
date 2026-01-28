<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Industry Code.
 *
 * @phpstan-type IndustryCodeShape = array{code: string, description?: string|null}
 */
final class IndustryCode implements BaseModel
{
    /** @use SdkModel<IndustryCodeShape> */
    use SdkModel;

    #[Required]
    public string $code;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new IndustryCode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IndustryCode::with(code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IndustryCode)->withCode(...)
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
    public static function with(string $code, ?string $description = null): self
    {
        $self = new self;

        $self['code'] = $code;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
