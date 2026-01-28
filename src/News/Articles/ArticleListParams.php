<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\ArticleListParams\Sorting;
use Businessradar\News\Articles\ArticleListParams\SortingOrder;

/**
 * Search News Articles.
 *
 * List Articles from the Business Radar platform, search using advanced queries or
 * check articles that have been published since last check.
 *
 * @see Businessradar\Services\News\ArticlesService::list()
 *
 * @phpstan-type ArticleListParamsShape = array{
 *   category?: list<string>|null,
 *   company?: list<string>|null,
 *   country?: list<string>|null,
 *   disableCompanyArticleDeduplication?: bool|null,
 *   dunsNumber?: list<string>|null,
 *   globalUltimate?: list<string>|null,
 *   includeClusteredArticles?: bool|null,
 *   isMaterial?: bool|null,
 *   language?: list<string>|null,
 *   maxCreationDate?: \DateTimeInterface|null,
 *   maxPublicationDate?: \DateTimeInterface|null,
 *   minCreationDate?: \DateTimeInterface|null,
 *   minPublicationDate?: \DateTimeInterface|null,
 *   nextKey?: string|null,
 *   portfolioID?: list<string>|null,
 *   query?: string|null,
 *   registrationNumber?: list<string>|null,
 *   savedArticleFilterID?: string|null,
 *   sentiment?: bool|null,
 *   sorting?: null|Sorting|value-of<Sorting>,
 *   sortingOrder?: null|SortingOrder|value-of<SortingOrder>,
 * }
 */
final class ArticleListParams implements BaseModel
{
    /** @use SdkModel<ArticleListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Category ID to filter articles.
     *
     * @var list<string>|null $category
     */
    #[Optional(list: 'string')]
    public ?array $category;

    /**
     * Company ID's.
     *
     * @var list<string>|null $company
     */
    #[Optional(list: 'string')]
    public ?array $company;

    /**
     * ISO 2-letter Country Code.
     *
     * @var list<string>|null $country
     */
    #[Optional(list: 'string')]
    public ?array $country;

    /**
     * By default companies with the same trade names are grouped and the best one is picked, the other ones are not included. By disabling this the amount of company articles will grow significantly.
     */
    #[Optional]
    public ?bool $disableCompanyArticleDeduplication;

    /**
     * 9-digit Dun And Bradstreet Number.
     *
     * @var list<string>|null $dunsNumber
     */
    #[Optional(list: 'string')]
    public ?array $dunsNumber;

    /**
     * 9-digit Dun And Bradstreet Number.
     *
     * @var list<string>|null $globalUltimate
     */
    #[Optional(list: 'string')]
    public ?array $globalUltimate;

    /**
     * Include clustered articles.
     */
    #[Optional]
    public ?bool $includeClusteredArticles;

    /**
     * Filter articles by materiality flag (true/false).
     */
    #[Optional]
    public ?bool $isMaterial;

    /**
     * ISO 2-letter Language Code.
     *
     * @var list<string>|null $language
     */
    #[Optional(list: 'string')]
    public ?array $language;

    /**
     * Filter articles created before this date.
     */
    #[Optional]
    public ?\DateTimeInterface $maxCreationDate;

    /**
     * Filter articles published before this date.
     */
    #[Optional]
    public ?\DateTimeInterface $maxPublicationDate;

    /**
     * Filter articles created after this date.
     */
    #[Optional]
    public ?\DateTimeInterface $minCreationDate;

    /**
     * Filter articles published after this date.
     */
    #[Optional]
    public ?\DateTimeInterface $minPublicationDate;

    /**
     * The next_key is an cursor used to make it possible to paginate to the next results, pass the next_key from the previous request to retrieve next results.
     */
    #[Optional]
    public ?string $nextKey;

    /**
     * Portfolio ID to filter articles.
     *
     * @var list<string>|null $portfolioID
     */
    #[Optional(list: 'string')]
    public ?array $portfolioID;

    /**
     * Custom search filters to text search all articles.
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
     * Filter articles on already saved article filter id.
     */
    #[Optional]
    public ?string $savedArticleFilterID;

    /**
     * Filter articles with sentiment.
     */
    #[Optional]
    public ?bool $sentiment;

    /**
     * Sort articles.
     *
     * @var value-of<Sorting>|null $sorting
     */
    #[Optional(enum: Sorting::class)]
    public ?string $sorting;

    /**
     * Sort order.
     *
     * @var value-of<SortingOrder>|null $sortingOrder
     */
    #[Optional(enum: SortingOrder::class)]
    public ?string $sortingOrder;

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
     * @param list<string>|null $language
     * @param list<string>|null $portfolioID
     * @param list<string>|null $registrationNumber
     * @param Sorting|value-of<Sorting>|null $sorting
     * @param SortingOrder|value-of<SortingOrder>|null $sortingOrder
     */
    public static function with(
        ?array $category = null,
        ?array $company = null,
        ?array $country = null,
        ?bool $disableCompanyArticleDeduplication = null,
        ?array $dunsNumber = null,
        ?array $globalUltimate = null,
        ?bool $includeClusteredArticles = null,
        ?bool $isMaterial = null,
        ?array $language = null,
        ?\DateTimeInterface $maxCreationDate = null,
        ?\DateTimeInterface $maxPublicationDate = null,
        ?\DateTimeInterface $minCreationDate = null,
        ?\DateTimeInterface $minPublicationDate = null,
        ?string $nextKey = null,
        ?array $portfolioID = null,
        ?string $query = null,
        ?array $registrationNumber = null,
        ?string $savedArticleFilterID = null,
        ?bool $sentiment = null,
        Sorting|string|null $sorting = null,
        SortingOrder|string|null $sortingOrder = null,
    ): self {
        $self = new self;

        null !== $category && $self['category'] = $category;
        null !== $company && $self['company'] = $company;
        null !== $country && $self['country'] = $country;
        null !== $disableCompanyArticleDeduplication && $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;
        null !== $dunsNumber && $self['dunsNumber'] = $dunsNumber;
        null !== $globalUltimate && $self['globalUltimate'] = $globalUltimate;
        null !== $includeClusteredArticles && $self['includeClusteredArticles'] = $includeClusteredArticles;
        null !== $isMaterial && $self['isMaterial'] = $isMaterial;
        null !== $language && $self['language'] = $language;
        null !== $maxCreationDate && $self['maxCreationDate'] = $maxCreationDate;
        null !== $maxPublicationDate && $self['maxPublicationDate'] = $maxPublicationDate;
        null !== $minCreationDate && $self['minCreationDate'] = $minCreationDate;
        null !== $minPublicationDate && $self['minPublicationDate'] = $minPublicationDate;
        null !== $nextKey && $self['nextKey'] = $nextKey;
        null !== $portfolioID && $self['portfolioID'] = $portfolioID;
        null !== $query && $self['query'] = $query;
        null !== $registrationNumber && $self['registrationNumber'] = $registrationNumber;
        null !== $savedArticleFilterID && $self['savedArticleFilterID'] = $savedArticleFilterID;
        null !== $sentiment && $self['sentiment'] = $sentiment;
        null !== $sorting && $self['sorting'] = $sorting;
        null !== $sortingOrder && $self['sortingOrder'] = $sortingOrder;

        return $self;
    }

    /**
     * Category ID to filter articles.
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
     * Company ID's.
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
     * By default companies with the same trade names are grouped and the best one is picked, the other ones are not included. By disabling this the amount of company articles will grow significantly.
     */
    public function withDisableCompanyArticleDeduplication(
        bool $disableCompanyArticleDeduplication
    ): self {
        $self = clone $this;
        $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;

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
     * 9-digit Dun And Bradstreet Number.
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
     * Include clustered articles.
     */
    public function withIncludeClusteredArticles(
        bool $includeClusteredArticles
    ): self {
        $self = clone $this;
        $self['includeClusteredArticles'] = $includeClusteredArticles;

        return $self;
    }

    /**
     * Filter articles by materiality flag (true/false).
     */
    public function withIsMaterial(bool $isMaterial): self
    {
        $self = clone $this;
        $self['isMaterial'] = $isMaterial;

        return $self;
    }

    /**
     * ISO 2-letter Language Code.
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
     * Filter articles created before this date.
     */
    public function withMaxCreationDate(
        \DateTimeInterface $maxCreationDate
    ): self {
        $self = clone $this;
        $self['maxCreationDate'] = $maxCreationDate;

        return $self;
    }

    /**
     * Filter articles published before this date.
     */
    public function withMaxPublicationDate(
        \DateTimeInterface $maxPublicationDate
    ): self {
        $self = clone $this;
        $self['maxPublicationDate'] = $maxPublicationDate;

        return $self;
    }

    /**
     * Filter articles created after this date.
     */
    public function withMinCreationDate(
        \DateTimeInterface $minCreationDate
    ): self {
        $self = clone $this;
        $self['minCreationDate'] = $minCreationDate;

        return $self;
    }

    /**
     * Filter articles published after this date.
     */
    public function withMinPublicationDate(
        \DateTimeInterface $minPublicationDate
    ): self {
        $self = clone $this;
        $self['minPublicationDate'] = $minPublicationDate;

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
     * Portfolio ID to filter articles.
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
     * Custom search filters to text search all articles.
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
     * Filter articles on already saved article filter id.
     */
    public function withSavedArticleFilterID(string $savedArticleFilterID): self
    {
        $self = clone $this;
        $self['savedArticleFilterID'] = $savedArticleFilterID;

        return $self;
    }

    /**
     * Filter articles with sentiment.
     */
    public function withSentiment(bool $sentiment): self
    {
        $self = clone $this;
        $self['sentiment'] = $sentiment;

        return $self;
    }

    /**
     * Sort articles.
     *
     * @param Sorting|value-of<Sorting> $sorting
     */
    public function withSorting(Sorting|string $sorting): self
    {
        $self = clone $this;
        $self['sorting'] = $sorting;

        return $self;
    }

    /**
     * Sort order.
     *
     * @param SortingOrder|value-of<SortingOrder> $sortingOrder
     */
    public function withSortingOrder(SortingOrder|string $sortingOrder): self
    {
        $self = clone $this;
        $self['sortingOrder'] = $sortingOrder;

        return $self;
    }
}
