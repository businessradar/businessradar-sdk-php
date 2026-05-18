<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Export;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Export\ArticleFilters\MediaType;

/**
 * ### Article Filters.
 *
 * Used to validate and process filters for article searches. Supports filtering by
 * query text, countries, languages, specific companies (DUNS), and portfolios.
 *
 * @phpstan-type ArticleFiltersShape = array{
 *   categories?: list<string>|null,
 *   companies?: list<string>|null,
 *   countries?: list<string>|null,
 *   disableCompanyArticleDeduplication?: bool|null,
 *   dunsNumbers?: list<string>|null,
 *   globalUltimates?: list<string>|null,
 *   includeClusteredArticles?: bool|null,
 *   industries?: list<string>|null,
 *   isMaterial?: bool|null,
 *   languages?: list<string>|null,
 *   maxCreationDate?: \DateTimeInterface|null,
 *   maxPublicationDate?: \DateTimeInterface|null,
 *   mediaType?: null|MediaType|value-of<MediaType>,
 *   minCreationDate?: \DateTimeInterface|null,
 *   minPublicationDate?: \DateTimeInterface|null,
 *   parentCategory?: string|null,
 *   portfolios?: list<string>|null,
 *   query?: string|null,
 *   registrationNumbers?: list<string>|null,
 *   sentiment?: bool|null,
 * }
 */
final class ArticleFilters implements BaseModel
{
    /** @use SdkModel<ArticleFiltersShape> */
    use SdkModel;

    /** @var list<string>|null $categories */
    #[Optional(list: 'string', nullable: true)]
    public ?array $categories;

    /** @var list<string>|null $companies */
    #[Optional(list: 'string', nullable: true)]
    public ?array $companies;

    /** @var list<string>|null $countries */
    #[Optional(list: 'string', nullable: true)]
    public ?array $countries;

    #[Optional('disable_company_article_deduplication')]
    public ?bool $disableCompanyArticleDeduplication;

    /** @var list<string>|null $dunsNumbers */
    #[Optional('duns_numbers', list: 'string', nullable: true)]
    public ?array $dunsNumbers;

    /** @var list<string>|null $globalUltimates */
    #[Optional('global_ultimates', list: 'string', nullable: true)]
    public ?array $globalUltimates;

    #[Optional('include_clustered_articles')]
    public ?bool $includeClusteredArticles;

    /** @var list<string>|null $industries */
    #[Optional(list: 'string', nullable: true)]
    public ?array $industries;

    #[Optional('is_material', nullable: true)]
    public ?bool $isMaterial;

    /** @var list<string>|null $languages */
    #[Optional(list: 'string', nullable: true)]
    public ?array $languages;

    #[Optional('max_creation_date', nullable: true)]
    public ?\DateTimeInterface $maxCreationDate;

    #[Optional('max_publication_date', nullable: true)]
    public ?\DateTimeInterface $maxPublicationDate;

    /** @var value-of<MediaType>|null $mediaType */
    #[Optional('media_type', enum: MediaType::class, nullable: true)]
    public ?string $mediaType;

    #[Optional('min_creation_date', nullable: true)]
    public ?\DateTimeInterface $minCreationDate;

    #[Optional('min_publication_date', nullable: true)]
    public ?\DateTimeInterface $minPublicationDate;

    #[Optional('parent_category', nullable: true)]
    public ?string $parentCategory;

    /** @var list<string>|null $portfolios */
    #[Optional(list: 'string', nullable: true)]
    public ?array $portfolios;

    #[Optional(nullable: true)]
    public ?string $query;

    /** @var list<string>|null $registrationNumbers */
    #[Optional('registration_numbers', list: 'string', nullable: true)]
    public ?array $registrationNumbers;

    #[Optional(nullable: true)]
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
     * @param list<string>|null $categories
     * @param list<string>|null $companies
     * @param list<string>|null $countries
     * @param list<string>|null $dunsNumbers
     * @param list<string>|null $globalUltimates
     * @param list<string>|null $industries
     * @param list<string>|null $languages
     * @param MediaType|value-of<MediaType>|null $mediaType
     * @param list<string>|null $portfolios
     * @param list<string>|null $registrationNumbers
     */
    public static function with(
        ?array $categories = null,
        ?array $companies = null,
        ?array $countries = null,
        ?bool $disableCompanyArticleDeduplication = null,
        ?array $dunsNumbers = null,
        ?array $globalUltimates = null,
        ?bool $includeClusteredArticles = null,
        ?array $industries = null,
        ?bool $isMaterial = null,
        ?array $languages = null,
        ?\DateTimeInterface $maxCreationDate = null,
        ?\DateTimeInterface $maxPublicationDate = null,
        MediaType|string|null $mediaType = null,
        ?\DateTimeInterface $minCreationDate = null,
        ?\DateTimeInterface $minPublicationDate = null,
        ?string $parentCategory = null,
        ?array $portfolios = null,
        ?string $query = null,
        ?array $registrationNumbers = null,
        ?bool $sentiment = null,
    ): self {
        $self = new self;

        null !== $categories && $self['categories'] = $categories;
        null !== $companies && $self['companies'] = $companies;
        null !== $countries && $self['countries'] = $countries;
        null !== $disableCompanyArticleDeduplication && $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;
        null !== $dunsNumbers && $self['dunsNumbers'] = $dunsNumbers;
        null !== $globalUltimates && $self['globalUltimates'] = $globalUltimates;
        null !== $includeClusteredArticles && $self['includeClusteredArticles'] = $includeClusteredArticles;
        null !== $industries && $self['industries'] = $industries;
        null !== $isMaterial && $self['isMaterial'] = $isMaterial;
        null !== $languages && $self['languages'] = $languages;
        null !== $maxCreationDate && $self['maxCreationDate'] = $maxCreationDate;
        null !== $maxPublicationDate && $self['maxPublicationDate'] = $maxPublicationDate;
        null !== $mediaType && $self['mediaType'] = $mediaType;
        null !== $minCreationDate && $self['minCreationDate'] = $minCreationDate;
        null !== $minPublicationDate && $self['minPublicationDate'] = $minPublicationDate;
        null !== $parentCategory && $self['parentCategory'] = $parentCategory;
        null !== $portfolios && $self['portfolios'] = $portfolios;
        null !== $query && $self['query'] = $query;
        null !== $registrationNumbers && $self['registrationNumbers'] = $registrationNumbers;
        null !== $sentiment && $self['sentiment'] = $sentiment;

        return $self;
    }

    /**
     * @param list<string>|null $categories
     */
    public function withCategories(?array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * @param list<string>|null $companies
     */
    public function withCompanies(?array $companies): self
    {
        $self = clone $this;
        $self['companies'] = $companies;

        return $self;
    }

    /**
     * @param list<string>|null $countries
     */
    public function withCountries(?array $countries): self
    {
        $self = clone $this;
        $self['countries'] = $countries;

        return $self;
    }

    public function withDisableCompanyArticleDeduplication(
        bool $disableCompanyArticleDeduplication
    ): self {
        $self = clone $this;
        $self['disableCompanyArticleDeduplication'] = $disableCompanyArticleDeduplication;

        return $self;
    }

    /**
     * @param list<string>|null $dunsNumbers
     */
    public function withDunsNumbers(?array $dunsNumbers): self
    {
        $self = clone $this;
        $self['dunsNumbers'] = $dunsNumbers;

        return $self;
    }

    /**
     * @param list<string>|null $globalUltimates
     */
    public function withGlobalUltimates(?array $globalUltimates): self
    {
        $self = clone $this;
        $self['globalUltimates'] = $globalUltimates;

        return $self;
    }

    public function withIncludeClusteredArticles(
        bool $includeClusteredArticles
    ): self {
        $self = clone $this;
        $self['includeClusteredArticles'] = $includeClusteredArticles;

        return $self;
    }

    /**
     * @param list<string>|null $industries
     */
    public function withIndustries(?array $industries): self
    {
        $self = clone $this;
        $self['industries'] = $industries;

        return $self;
    }

    public function withIsMaterial(?bool $isMaterial): self
    {
        $self = clone $this;
        $self['isMaterial'] = $isMaterial;

        return $self;
    }

    /**
     * @param list<string>|null $languages
     */
    public function withLanguages(?array $languages): self
    {
        $self = clone $this;
        $self['languages'] = $languages;

        return $self;
    }

    public function withMaxCreationDate(
        ?\DateTimeInterface $maxCreationDate
    ): self {
        $self = clone $this;
        $self['maxCreationDate'] = $maxCreationDate;

        return $self;
    }

    public function withMaxPublicationDate(
        ?\DateTimeInterface $maxPublicationDate
    ): self {
        $self = clone $this;
        $self['maxPublicationDate'] = $maxPublicationDate;

        return $self;
    }

    /**
     * @param MediaType|value-of<MediaType>|null $mediaType
     */
    public function withMediaType(MediaType|string|null $mediaType): self
    {
        $self = clone $this;
        $self['mediaType'] = $mediaType;

        return $self;
    }

    public function withMinCreationDate(
        ?\DateTimeInterface $minCreationDate
    ): self {
        $self = clone $this;
        $self['minCreationDate'] = $minCreationDate;

        return $self;
    }

    public function withMinPublicationDate(
        ?\DateTimeInterface $minPublicationDate
    ): self {
        $self = clone $this;
        $self['minPublicationDate'] = $minPublicationDate;

        return $self;
    }

    public function withParentCategory(?string $parentCategory): self
    {
        $self = clone $this;
        $self['parentCategory'] = $parentCategory;

        return $self;
    }

    /**
     * @param list<string>|null $portfolios
     */
    public function withPortfolios(?array $portfolios): self
    {
        $self = clone $this;
        $self['portfolios'] = $portfolios;

        return $self;
    }

    public function withQuery(?string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * @param list<string>|null $registrationNumbers
     */
    public function withRegistrationNumbers(?array $registrationNumbers): self
    {
        $self = clone $this;
        $self['registrationNumbers'] = $registrationNumbers;

        return $self;
    }

    public function withSentiment(?bool $sentiment): self
    {
        $self = clone $this;
        $self['sentiment'] = $sentiment;

        return $self;
    }
}
