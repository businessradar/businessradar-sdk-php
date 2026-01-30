<?php

declare(strict_types=1);

namespace Businessradar\Portfolios;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Portfolios.
 *
 * Manage collections of companies. This view allows you to list existing portfolios
 * associated with your profile or create new ones.
 *
 * @see Businessradar\Services\PortfoliosService::list()
 *
 * @phpstan-type PortfolioListParamsShape = array{nextKey?: string|null}
 */
final class PortfolioListParams implements BaseModel
{
    /** @use SdkModel<PortfolioListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
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
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }
}
