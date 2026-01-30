<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Analytics;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Analytics\AnalyticsGetCountByDateParams\Interval;

/**
 * ### Get Article Aggregations.
 *
 * Retrieve the number of articles and their average sentiment, grouped by date.
 *
 * @see Businessradar\Services\News\Articles\AnalyticsService::getCountByDate()
 *
 * @phpstan-type AnalyticsGetCountByDateParamsShape = array{
 *   category?: list<string>|null,
 *   company?: list<string>|null,
 *   country?: list<string>|null,
 *   disableCompanyArticleDeduplication?: bool|null,
 *   dunsNumber?: list<string>|null,
 *   globalUltimate?: list<string>|null,
 *   includeClusteredArticles?: bool|null,
 *   interval?: null|Interval|value-of<Interval>,
 *   isMaterial?: bool|null,
 *   language?: list<string>|null,
 *   maxCreationDate?: \DateTimeInterface|null,
 *   maxPublicationDate?: \DateTimeInterface|null,
 *   minCreationDate?: \DateTimeInterface|null,
 *   minPublicationDate?: \DateTimeInterface|null,
 *   portfolioID?: list<string>|null,
 *   query?: string|null,
 *   registrationNumber?: list<string>|null,
 *   savedArticleFilterID?: string|null,
 *   sentiment?: bool|null,
 * }
 */
final class AnalyticsGetCountByDateParams implements BaseModel
{
    /** @use SdkModel<AnalyticsGetCountByDateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by article Category IDs (UUIDs).
     *
     * @var list<string>|null $category
     */
    #[Optional(list: 'string')]
    public ?array $category;

    /**
     * Filter by internal Company UUIDs.
     *
     * @var list<string>|null $company
     */
    #[Optional(list: 'string')]
    public ?array $company;

    /**
     * Filter by ISO 2-letter Country Codes (e.g., 'US', 'GB').
     *
     * @var list<string>|null $country
     */
    #[Optional(list: 'string')]
    public ?array $country;

    /**
     * By default, companies with the same trade names are grouped and the best match is selected. Enable this to see all associated companies.
     */
    #[Optional]
    public ?bool $disableCompanyArticleDeduplication;

    /**
     * Filter by one or more 9-digit Dun & Bradstreet Numbers.
     *
     * @var list<string>|null $dunsNumber
     */
    #[Optional(list: 'string')]
    public ?array $dunsNumber;

    /**
     * Filter by Global Ultimate DUNS Numbers.
     *
     * @var list<string>|null $globalUltimate
     */
    #[Optional(list: 'string')]
    public ?array $globalUltimate;

    /**
     * Include articles that are part of a cluster (reprints or similar articles).
     */
    #[Optional]
    public ?bool $includeClusteredArticles;

    /**
     * The time interval for aggregation.
     *
     * @var value-of<Interval>|null $interval
     */
    #[Optional(enum: Interval::class)]
    public ?string $interval;

    /**
     * Filter by materiality flag (relevance to business risk).
     */
    #[Optional]
    public ?bool $isMaterial;

    /**
     * Filter by ISO 2-letter Language Codes (e.g., 'en', 'nl').
     *
     * @var list<string>|null $language
     */
    #[Optional(list: 'string')]
    public ?array $language;

    /**
     * Filter articles added to our database at or before this date/time.
     */
    #[Optional]
    public ?\DateTimeInterface $maxCreationDate;

    /**
     * Filter articles published at or before this date/time.
     */
    #[Optional]
    public ?\DateTimeInterface $maxPublicationDate;

    /**
     * Filter articles added to our database at or after this date/time.
     */
    #[Optional]
    public ?\DateTimeInterface $minCreationDate;

    /**
     * Filter articles published at or after this date/time.
     */
    #[Optional]
    public ?\DateTimeInterface $minPublicationDate;

    /**
     * Filter articles related to companies in specific Portfolios (UUIDs).
     *
     * @var list<string>|null $portfolioID
     */
    #[Optional(list: 'string')]
    public ?array $portfolioID;

    /**
     * Full-text search query for filtering articles by content.
     */
    #[Optional]
    public ?string $query;

    /**
     * Filter by local company registration numbers.
     *
     * @var list<string>|null $registrationNumber
     */
    #[Optional(list: 'string')]
    public ?array $registrationNumber;

    /**
     * Apply a previously saved set of article filters (UUID).
     */
    #[Optional]
    public ?string $savedArticleFilterID;

    /**
     * Filter by sentiment: `true` for positive, `false` for negative.
     */
    #[Optional]
    public ?bool $sentiment;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $category
     * @param list<string>|null $company
     * @param list<string>|null $country
     * @param list<string>|null $dunsNumber
     * @param list<string>|null $globalUltimate
     * @param Interval|value-of<Interval>|null $interval
     * @param list<string>|null $language
     * @param list<string>|null $portfolioID
     * @param list<string>|null $registrationNumber
     */
    public static function with(
        ?array $category = null,
        ?array $company = null,
        ?array $country = null,
        ?bool $disableCompanyArticleDeduplication = null,
        ?array $dunsNumber = null,
        ?array $globalUltimate = null,
        ?bool $includeClusteredArticles = null,
        Interval|string|null $interval = null,
        ?bool $isMaterial = null,
        ?array $language = null,
        ?\DateTimeInterface $maxCreationDate = null,
        ?\DateTimeInterface $maxPublicationDate = null,
        ?\DateTimeInterface $minCreationDate = null,
        ?\DateTimeInterface $minPublicationDate = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $savedArticleFilterID = null,
        ?bool $sentiment = null,
    ): self {
        $self = new self;

        null !== $category && $self['category'] = $category;
        null !== $company && $self['company'] = $company;
        null !== $country && $self['country'] = $country;
        null !== $disableCompanyArticleDeduplication && $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $globalUltimate && $self['globalUltimate'] = $globalUltimate;
        null !== $includeClusteredArticles && $self['includeClusteredArticles'] = $includeClusteredArticles;
        null !== $interval && $self['interval'] = $interval;
        null !== $isMaterial && $self['isMaterial'] = $isMaterial;
        null !== $language && $self['language'] = $language;
        null !== $maxCreationDate && $self['maxCreationDate'] = $maxCreationDate;
        null !== $maxPublicationDate && $self['maxPublicationDate'] = $maxPublicationDate;
        null !== $minCreationDate && $self['minCreationDate'] = $minCreationDate;
        null !== $minPublicationDate && $self['minPublicationDate'] = $minPublicationDate;
        null !== $portfolioID && $self['portfolioID'] = $portfolioID;
        null !== $query && $self['query'] = $query;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $savedArticleFilterID && $self['savedArticleFilterID'] = $savedArticleFilterID;
        null !== $sentiment && $self['sentiment'] = $sentiment;

        return $self;
    }

    /**
     * Filter by article Category IDs (UUIDs).
     *
     * @param list<string> $category
     */
    public function withCategory(array $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Filter by internal Company UUIDs.
     *
     * @param list<string> $company
     */
    public function withCompany(array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * Filter by ISO 2-letter Country Codes (e.g., 'US', 'GB').
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
     * By default, companies with the same trade names are grouped and the best match is selected. Enable this to see all associated companies.
     */
    public function withDisableCompanyArticleDeduplication(
        bool $disableCompanyArticleDeduplication
    ): self {
        $self = clone $this;
        $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;

        return $self;
    }

    /**
     * Filter by one or more 9-digit Dun & Bradstreet Numbers.
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
     * Filter by Global Ultimate DUNS Numbers.
     *
     * @param list<string> $globalUltimate
     */
    public function withGlobalUltimate(array $globalUltimate): self
    {
        $self = clone $this;
        $self['globalUltimate'] = $globalUltimate;

        return $self;
    }

    /**
     * Include articles that are part of a cluster (reprints or similar articles).
     */
    public function withIncludeClusteredArticles(
        bool $includeClusteredArticles
    ): self {
        $self = clone $this;
        $self['includeClusteredArticles'] = $includeClusteredArticles;

        return $self;
    }

    /**
     * The time interval for aggregation.
     *
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * Filter by materiality flag (relevance to business risk).
     */
    public function withIsMaterial(bool $isMaterial): self
    {
        $self = clone $this;
        $self['isMaterial'] = $isMaterial;

        return $self;
    }

    /**
     * Filter by ISO 2-letter Language Codes (e.g., 'en', 'nl').
     *
     * @param list<string> $language
     */
    public function withLanguage(array $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Filter articles added to our database at or before this date/time.
     */
    public function withMaxCreationDate(
        \DateTimeInterface $maxCreationDate
    ): self {
        $self = clone $this;
        $self['maxCreationDate'] = $maxCreationDate;

        return $self;
    }

    /**
     * Filter articles published at or before this date/time.
     */
    public function withMaxPublicationDate(
        \DateTimeInterface $maxPublicationDate
    ): self {
        $self = clone $this;
        $self['maxPublicationDate'] = $maxPublicationDate;

        return $self;
    }

    /**
     * Filter articles added to our database at or after this date/time.
     */
    public function withMinCreationDate(
        \DateTimeInterface $minCreationDate
    ): self {
        $self = clone $this;
        $self['minCreationDate'] = $minCreationDate;

        return $self;
    }

    /**
     * Filter articles published at or after this date/time.
     */
    public function withMinPublicationDate(
        \DateTimeInterface $minPublicationDate
    ): self {
        $self = clone $this;
        $self['minPublicationDate'] = $minPublicationDate;

        return $self;
    }

    /**
     * Filter articles related to companies in specific Portfolios (UUIDs).
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
     * Full-text search query for filtering articles by content.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Filter by local company registration numbers.
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
     * Apply a previously saved set of article filters (UUID).
     */
    public function withSavedArticleFilterID(string $savedArticleFilterID): self
    {
        $self = clone $this;
        $self['savedArticleFilterID'] = $savedArticleFilterID;

        return $self;
    }

    /**
     * Filter by sentiment: `true` for positive, `false` for negative.
     */
    public function withSentiment(bool $sentiment): self
    {
        $self = clone $this;
        $self['sentiment'] = $sentiment;

        return $self;
    }
}
