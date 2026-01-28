<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * List Company Updates.
 *
 * @see Businessradar\Services\CompaniesService::listAttributeChanges()
 *
 * @phpstan-type CompanyListAttributeChangesParamsShape = array{
 *   maxCreatedAt?: \DateTimeInterface|null,
 *   minCreatedAt?: \DateTimeInterface|null,
 *   nextKey?: string|null,
 * }
 */
final class CompanyListAttributeChangesParams implements BaseModel
{
    /** @use SdkModel<CompanyListAttributeChangesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter updates created at or before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $maxCreatedAt;

    /**
     * Filter updates created at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $minCreatedAt;

    /**
     * The next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results.
     */
    #[Optional]
    public ?string $nextKey;

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
        ?\DateTimeInterface $maxCreatedAt = null,
        ?\DateTimeInterface $minCreatedAt = null,
        ?string $nextKey = null,
    ): self {
        $self = new self;

        null !== $maxCreatedAt && $self['maxCreatedAt'] = $maxCreatedAt;
        null !== $minCreatedAt && $self['minCreatedAt'] = $minCreatedAt;
        null !== $nextKey && $self['nextKey'] = $nextKey;

        return $self;
    }

    /**
     * Filter updates created at or before this time.
     */
    public function withMaxCreatedAt(\DateTimeInterface $maxCreatedAt): self
    {
        $self = clone $this;
        $self['maxCreatedAt'] = $maxCreatedAt;

        return $self;
    }

    /**
     * Filter updates created at or after this time.
     */
    public function withMinCreatedAt(\DateTimeInterface $minCreatedAt): self
    {
        $self = clone $this;
        $self['minCreatedAt'] = $minCreatedAt;

        return $self;
    }

    /**
     * The next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }
}
