<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Search all companies using Dun and Bradstreet.
 *
 * Companies will contain an optional external_id, which is null if company is not
 * registered in Business Radar.
 *
 * When you pass query and optional country it will search using dun and
 * bradstreet, otherwise using internal search.
 *
 * @see Businessradar\Services\CompaniesService::list()
 *
 * @phpstan-type CompanyListParamsShape = array{
 *   country?: list<string>|null,
 *   dunsNumber?: list<string>|null,
 *   nextKey?: string|null,
 *   portfolioID?: list<string>|null,
 *   query?: string|null,
 *   registrationNumber?: list<string>|null,
 *   websiteURL?: string|null,
 * }
 */
final class CompanyListParams implements BaseModel
{
    /** @use SdkModel<CompanyListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO 2-letter Country Code.
     *
     * @var list<string>|null $country
     */
    #[Optional(list: 'string')]
    public ?array $country;

    /**
     * 9-digit Dun And Bradstreet Number.
     *
     * @var list<string>|null $dunsNumber
     */
    #[Optional(list: 'string')]
    public ?array $dunsNumber;

    /**
     * The next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Portfolio ID to filter companies.
     *
     * @var list<string>|null $portfolioID
     */
    #[Optional(list: 'string')]
    public ?array $portfolioID;

    /**
     * Custom search query to text search all companies.
     */
    #[Optional]
    public ?string $query;

    /**
     * Local Registration Number.
     *
     * @var list<string>|null $registrationNumber
     */
    #[Optional(list: 'string')]
    public ?array $registrationNumber;

    /**
     * Website URL to search.
     */
    #[Optional]
    public ?string $websiteURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $country
     * @param list<string>|null $dunsNumber
     * @param list<string>|null $portfolioID
     * @param list<string>|null $registrationNumber
     */
    public static function with(
        ?array $country = null,
        ?array $dunsNumber = null,
        ?string $nextKey = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $websiteURL = null,
    ): self {
        $self = new self;

        null !== $country && $self['country'] = $country;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $nextKey && $self['nextKey'] = $nextKey;
        null !== $portfolioID && $self['portfolioID'] = $portfolioID;
        null !== $query && $self['query'] = $query;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $websiteURL && $self['websiteURL'] = $websiteURL;

        return $self;
    }

    /**
     * ISO 2-letter Country Code.
     *
     * @param list<string> $country
     */
    public function withCountry(array $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * 9-digit Dun And Bradstreet Number.
     *
     * @param list<string> $dunsNumber
     */
    public function withDunsNumber(array $dunsNumber): self
    {
        $self = clone $this;
        $self['dunsNumber'] = $dunsNumber;

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

    /**
     * Portfolio ID to filter companies.
     *
     * @param list<string> $portfolioID
     */
    public function withPortfolioID(array $portfolioID): self
    {
        $self = clone $this;
        $self['portfolioID'] = $portfolioID;

        return $self;
    }

    /**
     * Custom search query to text search all companies.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Local Registration Number.
     *
     * @param list<string> $registrationNumber
     */
    public function withRegistrationNumber(array $registrationNumber): self
    {
        $self = clone $this;
        $self['registrationNumber'] = $registrationNumber;

        return $self;
    }

    /**
     * Website URL to search.
     */
    public function withWebsiteURL(string $websiteURL): self
    {
        $self = clone $this;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }
}
