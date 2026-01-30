<?php

declare(strict_types=1);

namespace Businessradar\Portfolios\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Portfolio Companies.
 *
 * Manage companies within a specific portfolio. - **GET**: List all companies
 * currently in the portfolio. - **POST**: Register and add a new company to the
 * portfolio.
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
