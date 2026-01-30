<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Article\CompanyArticle;
use Businessradar\News\Articles\Article\Country;
use Businessradar\News\Articles\Article\IsPaywalled;
use Businessradar\News\Articles\Article\Source;
use Businessradar\News\Articles\Article\SubArticle;

/**
 * ### Article.
 *
 * The primary data structure for news articles. It provides comprehensive data,
 * including: - Metadata (URLs, publication dates, languages, countries) - Content
 * (titles, snippets, summaries - both original and translated) - Relationships
 * (source, related companies, categories) - Analysis (sentiment, clustering status)
 *
 * @phpstan-import-type SourceShape from \Businessradar\News\Articles\Article\Source
 * @phpstan-import-type SubArticleShape from \Businessradar\News\Articles\Article\SubArticle
 *
 * @phpstan-type ArticleShape = array{
 *   categories: list<mixed>,
 *   companyArticles: list<mixed>,
 *   createdAt: \DateTimeInterface,
 *   imageURL: string,
 *   isClustered: bool,
 *   language: LanguageEnum|value-of<LanguageEnum>,
 *   publicationDatetime: \DateTimeInterface,
 *   snippet: string,
 *   snippetEn: string,
 *   source: Source|SourceShape,
 *   subArticles: list<SubArticle|SubArticleShape>,
 *   title: string,
 *   titleEn: string,
 *   updatedAt: \DateTimeInterface,
 *   url: string,
 *   country?: null|Country|value-of<Country>,
 *   externalID?: string|null,
 *   isPaywalled?: null|IsPaywalled|value-of<IsPaywalled>,
 *   sentiment?: float|null,
 *   summary?: string|null,
 *   summaryEn?: string|null,
 * }
 */
final class Article implements BaseModel
{
    /** @use SdkModel<ArticleShape> */
    use SdkModel;

    /** @var list<mixed> $categories */
    #[Required(list: CategoryTree::class)]
    public array $categories;

    /** @var list<mixed> $companyArticles */
    #[Required('company_articles', list: CompanyArticle::class)]
    public array $companyArticles;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Get Image URL if allowed for source.
     */
    #[Required('image_url')]
    public string $imageURL;

    /**
     * Check if article is clustered.
     */
    #[Required('is_clustered')]
    public bool $isClustered;

    /**
     * * `af` - Afrikaans
     * * `ar` - Arabic
     * * `az` - Azerbaijani
     * * `bg` - Bulgarian
     * * `be` - Belarusian
     * * `bn` - Bengali
     * * `br` - Breton
     * * `bs` - Bosnian
     * * `ca` - Catalan
     * * `cs` - Czech
     * * `cy` - Welsh
     * * `da` - Danish
     * * `de` - German
     * * `el` - Greek
     * * `en` - English
     * * `eo` - Esperanto
     * * `es` - Spanish
     * * `et` - Estonian
     * * `eu` - Basque
     * * `fa` - Persian
     * * `fi` - Finnish
     * * `fr` - French
     * * `fy` - Frisian
     * * `ga` - Irish
     * * `gd` - Scottish Gaelic
     * * `gl` - Galician
     * * `he` - Hebrew
     * * `hi` - Hindi
     * * `hr` - Croatian
     * * `hu` - Hungarian
     * * `hy` - Armenian
     * * `ia` - Interlingua
     * * `id` - Indonesian
     * * `ig` - Igbo
     * * `io` - Ido
     * * `is` - Icelandic
     * * `it` - Italian
     * * `ja` - Japanese
     * * `ka` - Georgian
     * * `kk` - Kazakh
     * * `km` - Khmer
     * * `no` - Norwegian
     * * `kn` - Kannada
     * * `ko` - Korean
     * * `ky` - Kyrgyz
     * * `lb` - Luxembourgish
     * * `lt` - Lithuanian
     * * `lv` - Latvian
     * * `mk` - Macedonian
     * * `ml` - Malayalam
     * * `mn` - Mongolian
     * * `mr` - Marathi
     * * `my` - Burmese
     * * `ne` - Nepali
     * * `nl` - Dutch
     * * `os` - Ossetic
     * * `pa` - Punjabi
     * * `pl` - Polish
     * * `pt` - Portuguese
     * * `ro` - Romanian
     * * `ru` - Russian
     * * `sk` - Slovak
     * * `sl` - Slovenian
     * * `sq` - Albanian
     * * `sr` - Serbian
     * * `sv` - Swedish
     * * `sw` - Swahili
     * * `ta` - Tamil
     * * `te` - Telugu
     * * `tg` - Tajik
     * * `th` - Thai
     * * `tk` - Turkmen
     * * `tr` - Turkish
     * * `tt` - Tatar
     * * `uk` - Ukrainian
     * * `ur` - Urdu
     * * `uz` - Uzbek
     * * `vi` - Vietnamese
     * * `zh` - Chinese.
     *
     * @var value-of<LanguageEnum> $language
     */
    #[Required(enum: LanguageEnum::class)]
    public string $language;

    /**
     * Calculate publication datetime of article.
     */
    #[Required('publication_datetime')]
    public \DateTimeInterface $publicationDatetime;

    /**
     * Get snippet if allowed for source.
     */
    #[Required]
    public string $snippet;

    /**
     * Get snippet if allowed for source.
     */
    #[Required('snippet_en')]
    public string $snippetEn;

    /**
     * ### Source.
     *
     * Represents the origin of a news article, including its domain, URL, and name.
     */
    #[Required]
    public Source $source;

    /** @var list<SubArticle> $subArticles */
    #[Required('sub_articles', list: SubArticle::class)]
    public array $subArticles;

    #[Required]
    public string $title;

    #[Required('title_en')]
    public string $titleEn;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Required]
    public string $url;

    /** @var value-of<Country>|null $country */
    #[Optional(enum: Country::class, nullable: true)]
    public ?string $country;

    #[Optional('external_id')]
    public ?string $externalID;

    /** @var value-of<IsPaywalled>|null $isPaywalled */
    #[Optional('is_paywalled', enum: IsPaywalled::class, nullable: true)]
    public ?string $isPaywalled;

    #[Optional(nullable: true)]
    public ?float $sentiment;

    #[Optional(nullable: true)]
    public ?string $summary;

    #[Optional('summary_en', nullable: true)]
    public ?string $summaryEn;

    /**
     * `new Article()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Article::with(
     *   categories: ...,
     *   companyArticles: ...,
     *   createdAt: ...,
     *   imageURL: ...,
     *   isClustered: ...,
     *   language: ...,
     *   publicationDatetime: ...,
     *   snippet: ...,
     *   snippetEn: ...,
     *   source: ...,
     *   subArticles: ...,
     *   title: ...,
     *   titleEn: ...,
     *   updatedAt: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Article)
     *   ->withCategories(...)
     *   ->withCompanyArticles(...)
     *   ->withCreatedAt(...)
     *   ->withImageURL(...)
     *   ->withIsClustered(...)
     *   ->withLanguage(...)
     *   ->withPublicationDatetime(...)
     *   ->withSnippet(...)
     *   ->withSnippetEn(...)
     *   ->withSource(...)
     *   ->withSubArticles(...)
     *   ->withTitle(...)
     *   ->withTitleEn(...)
     *   ->withUpdatedAt(...)
     *   ->withURL(...)
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
     *
     * @param list<mixed> $categories
     * @param list<mixed> $companyArticles
     * @param LanguageEnum|value-of<LanguageEnum> $language
     * @param Source|SourceShape $source
     * @param list<SubArticle|SubArticleShape> $subArticles
     * @param Country|value-of<Country>|null $country
     * @param IsPaywalled|value-of<IsPaywalled>|null $isPaywalled
     */
    public static function with(
        array $categories,
        array $companyArticles,
        \DateTimeInterface $createdAt,
        string $imageURL,
        bool $isClustered,
        LanguageEnum|string $language,
        \DateTimeInterface $publicationDatetime,
        string $snippet,
        string $snippetEn,
        Source|array $source,
        array $subArticles,
        string $title,
        string $titleEn,
        \DateTimeInterface $updatedAt,
        string $url,
        Country|string|null $country = null,
        ?string $externalID = null,
        IsPaywalled|string|null $isPaywalled = null,
        ?float $sentiment = null,
        ?string $summary = null,
        ?string $summaryEn = null,
    ): self {
        $self = new self;

        $self['categories'] = $categories;
        $self['companyArticles'] = $companyArticles;
        $self['createdAt'] = $createdAt;
        $self['imageURL'] = $imageURL;
        $self['isClustered'] = $isClustered;
        $self['language'] = $language;
        $self['publicationDatetime'] = $publicationDatetime;
        $self['snippet'] = $snippet;
        $self['snippetEn'] = $snippetEn;
        $self['source'] = $source;
        $self['subArticles'] = $subArticles;
        $self['title'] = $title;
        $self['titleEn'] = $titleEn;
        $self['updatedAt'] = $updatedAt;
        $self['url'] = $url;

        null !== $country && $self['country'] = $country;
        null !== $externalID && $self['externalID'] = $externalID;
        null !== $isPaywalled && $self['isPaywalled'] = $isPaywalled;
        null !== $sentiment && $self['sentiment'] = $sentiment;
        null !== $summary && $self['summary'] = $summary;
        null !== $summaryEn && $self['summaryEn'] = $summaryEn;

        return $self;
    }

    /**
     * @param list<mixed> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * @param list<mixed> $companyArticles
     */
    public function withCompanyArticles(array $companyArticles): self
    {
        $self = clone $this;
        $self['companyArticles'] = $companyArticles;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Get Image URL if allowed for source.
     */
    public function withImageURL(string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Check if article is clustered.
     */
    public function withIsClustered(bool $isClustered): self
    {
        $self = clone $this;
        $self['isClustered'] = $isClustered;

        return $self;
    }

    /**
     * * `af` - Afrikaans
     * * `ar` - Arabic
     * * `az` - Azerbaijani
     * * `bg` - Bulgarian
     * * `be` - Belarusian
     * * `bn` - Bengali
     * * `br` - Breton
     * * `bs` - Bosnian
     * * `ca` - Catalan
     * * `cs` - Czech
     * * `cy` - Welsh
     * * `da` - Danish
     * * `de` - German
     * * `el` - Greek
     * * `en` - English
     * * `eo` - Esperanto
     * * `es` - Spanish
     * * `et` - Estonian
     * * `eu` - Basque
     * * `fa` - Persian
     * * `fi` - Finnish
     * * `fr` - French
     * * `fy` - Frisian
     * * `ga` - Irish
     * * `gd` - Scottish Gaelic
     * * `gl` - Galician
     * * `he` - Hebrew
     * * `hi` - Hindi
     * * `hr` - Croatian
     * * `hu` - Hungarian
     * * `hy` - Armenian
     * * `ia` - Interlingua
     * * `id` - Indonesian
     * * `ig` - Igbo
     * * `io` - Ido
     * * `is` - Icelandic
     * * `it` - Italian
     * * `ja` - Japanese
     * * `ka` - Georgian
     * * `kk` - Kazakh
     * * `km` - Khmer
     * * `no` - Norwegian
     * * `kn` - Kannada
     * * `ko` - Korean
     * * `ky` - Kyrgyz
     * * `lb` - Luxembourgish
     * * `lt` - Lithuanian
     * * `lv` - Latvian
     * * `mk` - Macedonian
     * * `ml` - Malayalam
     * * `mn` - Mongolian
     * * `mr` - Marathi
     * * `my` - Burmese
     * * `ne` - Nepali
     * * `nl` - Dutch
     * * `os` - Ossetic
     * * `pa` - Punjabi
     * * `pl` - Polish
     * * `pt` - Portuguese
     * * `ro` - Romanian
     * * `ru` - Russian
     * * `sk` - Slovak
     * * `sl` - Slovenian
     * * `sq` - Albanian
     * * `sr` - Serbian
     * * `sv` - Swedish
     * * `sw` - Swahili
     * * `ta` - Tamil
     * * `te` - Telugu
     * * `tg` - Tajik
     * * `th` - Thai
     * * `tk` - Turkmen
     * * `tr` - Turkish
     * * `tt` - Tatar
     * * `uk` - Ukrainian
     * * `ur` - Urdu
     * * `uz` - Uzbek
     * * `vi` - Vietnamese
     * * `zh` - Chinese.
     *
     * @param LanguageEnum|value-of<LanguageEnum> $language
     */
    public function withLanguage(LanguageEnum|string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Calculate publication datetime of article.
     */
    public function withPublicationDatetime(
        \DateTimeInterface $publicationDatetime
    ): self {
        $self = clone $this;
        $self['publicationDatetime'] = $publicationDatetime;

        return $self;
    }

    /**
     * Get snippet if allowed for source.
     */
    public function withSnippet(string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    /**
     * Get snippet if allowed for source.
     */
    public function withSnippetEn(string $snippetEn): self
    {
        $self = clone $this;
        $self['snippetEn'] = $snippetEn;

        return $self;
    }

    /**
     * ### Source.
     *
     * Represents the origin of a news article, including its domain, URL, and name.
     *
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param list<SubArticle|SubArticleShape> $subArticles
     */
    public function withSubArticles(array $subArticles): self
    {
        $self = clone $this;
        $self['subArticles'] = $subArticles;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withTitleEn(string $titleEn): self
    {
        $self = clone $this;
        $self['titleEn'] = $titleEn;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * @param Country|value-of<Country>|null $country
     */
    public function withCountry(Country|string|null $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * @param IsPaywalled|value-of<IsPaywalled>|null $isPaywalled
     */
    public function withIsPaywalled(IsPaywalled|string|null $isPaywalled): self
    {
        $self = clone $this;
        $self['isPaywalled'] = $isPaywalled;

        return $self;
    }

    public function withSentiment(?float $sentiment): self
    {
        $self = clone $this;
        $self['sentiment'] = $sentiment;

        return $self;
    }

    public function withSummary(?string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    public function withSummaryEn(?string $summaryEn): self
    {
        $self = clone $this;
        $self['summaryEn'] = $summaryEn;

        return $self;
    }
}
