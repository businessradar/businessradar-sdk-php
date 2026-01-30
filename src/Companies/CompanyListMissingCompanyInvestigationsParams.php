<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Missing Company Investigations.
 *
 * List existing investigations or submit a new one for a company that could not be
 * found.
 *
 * @see Businessradar\Services\CompaniesService::listMissingCompanyInvestigations()
 *
 * @phpstan-type CompanyListMissingCompanyInvestigationsParamsShape = array{
 *   nextKey?: string|null
 * }
 */
final class CompanyListMissingCompanyInvestigationsParams implements BaseModel
{
    /** @use SdkModel<CompanyListMissingCompanyInvestigationsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
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
     * An opaque cursor value used for pagination. Pass the `next_key` received from a previous response to retrieve the next set of results.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }
}
