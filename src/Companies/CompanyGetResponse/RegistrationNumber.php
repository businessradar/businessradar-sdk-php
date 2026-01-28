<?php

declare(strict_types=1);

namespace Businessradar\Companies\CompanyGetResponse;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Registration Number.
 *
 * @phpstan-type RegistrationNumberShape = array{
 *   description: string, number: string, type: int
 * }
 */
final class RegistrationNumber implements BaseModel
{
    /** @use SdkModel<RegistrationNumberShape> */
    use SdkModel;

    #[Required]
    public string $description;

    #[Required]
    public string $number;

    /**
     * Dun and Bradstreet type code for the source of thisRegistration number.
     */
    #[Required]
    public int $type;

    /**
     * `new RegistrationNumber()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RegistrationNumber::with(description: ..., number: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RegistrationNumber)->withDescription(...)->withNumber(...)->withType(...)
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
    public static function with(
        string $description,
        string $number,
        int $type
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['number'] = $number;
        $self['type'] = $type;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withNumber(string $number): self
    {
        $self = clone $this;
        $self['number'] = $number;

        return $self;
    }

    /**
     * Dun and Bradstreet type code for the source of thisRegistration number.
     */
    public function withType(int $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
