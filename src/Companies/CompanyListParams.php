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
 * - A nonempty `query` with at most one `country` uses Dun & Bradstreet
 * unless a website domain or additional filters require internal search.
 *
 * - A resolved website domain, multiple countries, no query, or additional
 * filters (like `portfolio_id`) select internal search. `registration_number`,
 * `include_annotations`, `page_size`, and `next_key` do not change routing.
 *
 * The results include an `external_id` if the company is already registered in
 * Business Radar.
 *
 * `page_size` defaults to 50 and accepts integers from 1 through 100;
 * invalid sizes or filters raise `ValidationError` (400). Internal results
 * support `next_key` continuation; undecodable cursors raise `ValidationError`.
 * Dun & Bradstreet requests are capped at 50, ignore `next_key`, and return
 * a null cursor with `total_results` equal to the returned result count.
 *
 * Dun & Bradstreet 404 responses become empty results. Its throttling,
 * invalid-input, and connection exceptions propagate, as do internal search
 * errors. Website parsing failures fall back to the supplied URL unchanged.
 *
 * `min_created_at`, `max_created_at`, `min_updated_at` and `max_updated_at`
 * filter on when a company was added or last updated (inclusive, ISO 8601,
 * UTC). They use internal search, sort results by that timestamp, and cannot
 * be combined with `query`.
 *
 * @see Businessradar\Services\CompaniesService::list()
 *
 * @phpstan-type CompanyListParamsShape = array{
 *   country?: list<string>|null,
 *   dunsNumber?: list<string>|null,
 *   isListed?: bool|null,
 *   maxCreatedAt?: \DateTimeInterface|null,
 *   maxUpdatedAt?: \DateTimeInterface|null,
 *   minCreatedAt?: \DateTimeInterface|null,
 *   minUpdatedAt?: \DateTimeInterface|null,
 *   nextKey?: string|null,
 *   pageSize?: int|null,
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
     * Filter on publicly listed companies (has a `ticker_symbol`).
     */
    #[Optional]
    public ?bool $isListed;

    /**
     * Companies added at or before this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    #[Optional]
    public ?\DateTimeInterface $maxCreatedAt;

    /**
     * Companies updated at or before this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    #[Optional]
    public ?\DateTimeInterface $maxUpdatedAt;

    /**
     * Companies added at or after this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    #[Optional]
    public ?\DateTimeInterface $minCreatedAt;

    /**
     * Companies updated at or after this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    #[Optional]
    public ?\DateTimeInterface $minUpdatedAt;

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Number of results per page. Default 50, max 100. Dun & Bradstreet results (no other filters besides `query`/`country`) are capped at 50 and do not support continuation.
     */
    #[Optional]
    public ?int $pageSize;

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
        ?bool $isListed = null,
        ?\DateTimeInterface $maxCreatedAt = null,
        ?\DateTimeInterface $maxUpdatedAt = null,
        ?\DateTimeInterface $minCreatedAt = null,
        ?\DateTimeInterface $minUpdatedAt = null,
        ?string $nextKey = null,
        ?int $pageSize = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $websiteURL = null,
    ): self {
        $self = new self;

        null !== $country && $self['country'] = $country;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $isListed && $self['isListed'] = $isListed;
        null !== $maxCreatedAt && $self['maxCreatedAt'] = $maxCreatedAt;
        null !== $maxUpdatedAt && $self['maxUpdatedAt'] = $maxUpdatedAt;
        null !== $minCreatedAt && $self['minCreatedAt'] = $minCreatedAt;
        null !== $minUpdatedAt && $self['minUpdatedAt'] = $minUpdatedAt;
        null !== $nextKey && $self['nextKey'] = $nextKey;
        null !== $pageSize && $self['pageSize'] = $pageSize;
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
     * Filter on publicly listed companies (has a `ticker_symbol`).
     */
    public function withIsListed(bool $isListed): self
    {
        $self = clone $this;
        $self['isListed'] = $isListed;

        return $self;
    }

    /**
     * Companies added at or before this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    public function withMaxCreatedAt(\DateTimeInterface $maxCreatedAt): self
    {
        $self = clone $this;
        $self['maxCreatedAt'] = $maxCreatedAt;

        return $self;
    }

    /**
     * Companies updated at or before this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    public function withMaxUpdatedAt(\DateTimeInterface $maxUpdatedAt): self
    {
        $self = clone $this;
        $self['maxUpdatedAt'] = $maxUpdatedAt;

        return $self;
    }

    /**
     * Companies added at or after this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    public function withMinCreatedAt(\DateTimeInterface $minCreatedAt): self
    {
        $self = clone $this;
        $self['minCreatedAt'] = $minCreatedAt;

        return $self;
    }

    /**
     * Companies updated at or after this time (inclusive). ISO 8601, UTC when no offset is given, millisecond precision. Cannot be combined with `query`.
     */
    public function withMinUpdatedAt(\DateTimeInterface $minUpdatedAt): self
    {
        $self = clone $this;
        $self['minUpdatedAt'] = $minUpdatedAt;

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
     * Number of results per page. Default 50, max 100. Dun & Bradstreet results (no other filters besides `query`/`country`) are capped at 50 and do not support continuation.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

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
