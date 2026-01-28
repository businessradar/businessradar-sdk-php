<?php

declare(strict_types=1);

namespace Businessradar\Portfolios\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * List And Create Portfolio Companies.
 *
 * @see Businessradar\Services\Portfolios\CompaniesService::list()
 *
 * @phpstan-type CompanyListParamsShape = array{nextKey?: string|null}
 */
final class CompanyListParams implements BaseModel
{
    /** @use SdkModel<CompanyListParamsShape> */
    use SdkModel;
    use SdkParams;

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
    public static function with(?string $nextKey = null): self
    {
        $self = new self;

        null !== $nextKey && $self['nextKey'] = $nextKey;

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
