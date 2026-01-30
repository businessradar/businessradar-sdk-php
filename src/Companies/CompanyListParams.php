<?php

declare(strict_types=1);

namespace Businessradar\Companies;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Search Companies.
 *
 * Search for companies across internal and external databases.
 *
 * - If `query` and an optional `country` are provided, the search is primarily
 * conducted via Dun & Bradstreet.
 *
 * - If other filters (like `portfolio_id`) are provided, the search is limited to
 * our internal database.
 *
 * The results include an `external_id` if the company is already registered in
 * Business Radar.
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
     * ISO 2-letter Country Code (e.g., NL, US).
     *
     * @var list<string>|null $country
     */
    #[Optional(list: 'string')]
    public ?array $country;

    /**
     * 9-digit Dun And Bradstreet Number (can be multiple).
     *
     * @var list<string>|null $dunsNumber
     */
    #[Optional(list: 'string')]
    public ?array $dunsNumber;

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Filter companies belonging to specific Portfolio IDs (UUID).
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
     * Local Registration Number (can be multiple).
     *
     * @var list<string>|null $registrationNumber
     */
    #[Optional(list: 'string')]
    public ?array $registrationNumber;

    /**
     * Website URL to search for the company.
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
     * ISO 2-letter Country Code (e.g., NL, US).
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
     * 9-digit Dun And Bradstreet Number (can be multiple).
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
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    public function withNextKey(string $nextKey): self
    {
        $self = clone $this;
        $self['nextKey'] = $nextKey;

        return $self;
    }

    /**
     * Filter companies belonging to specific Portfolio IDs (UUID).
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
     * Local Registration Number (can be multiple).
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
     * Website URL to search for the company.
     */
    public function withWebsiteURL(string $websiteURL): self
    {
        $self = clone $this;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }
}
