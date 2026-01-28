<?php

declare(strict_types=1);

namespace Businessradar\Portfolios\Companies;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Remove Portfolio Companies.
 *
 * @see Businessradar\Services\Portfolios\CompaniesService::delete()
 *
 * @phpstan-type CompanyDeleteParamsShape = array{portfolioID: string}
 */
final class CompanyDeleteParams implements BaseModel
{
    /** @use SdkModel<CompanyDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $portfolioID;

    /**
     * `new CompanyDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyDeleteParams::with(portfolioID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyDeleteParams)->withPortfolioID(...)
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
    public static function with(string $portfolioID): self
    {
        $self = new self;

        $self['portfolioID'] = $portfolioID;

        return $self;
    }

    public function withPortfolioID(string $portfolioID): self
    {
        $self = clone $this;
        $self['portfolioID'] = $portfolioID;

        return $self;
    }
}
