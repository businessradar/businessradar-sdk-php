<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Article;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Article\CompanyArticle\Company;
use Businessradar\News\Articles\CategoryTree;

/**
 * ### Company-Article.
 *
 * The relationship between a company and a specific article, including snippets and
 * sentiment analysis relevant to that company.
 *
 * @phpstan-import-type CompanyShape from \Businessradar\News\Articles\Article\CompanyArticle\Company
 *
 * @phpstan-type CompanyArticleShape = array{
 *   categories: list<mixed>,
 *   company: Company|CompanyShape,
 *   sentiment?: float|null,
 *   snippet?: string|null,
 *   snippetEn?: string|null,
 * }
 */
final class CompanyArticle implements BaseModel
{
    /** @use SdkModel<CompanyArticleShape> */
    use SdkModel;

    /** @var list<mixed> $categories */
    #[Required(list: CategoryTree::class)]
    public array $categories;

    /**
     * ### News Company.
     *
     * Company information when associated with news articles. Includes DUNS numbers and an
     * optional customer reference.
     */
    #[Required]
    public Company $company;

    #[Optional(nullable: true)]
    public ?float $sentiment;

    #[Optional(nullable: true)]
    public ?string $snippet;

    #[Optional('snippet_en', nullable: true)]
    public ?string $snippetEn;

    /**
     * `new CompanyArticle()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CompanyArticle::with(categories: ..., company: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CompanyArticle)->withCategories(...)->withCompany(...)
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
     * @param Company|CompanyShape $company
     */
    public static function with(
        array $categories,
        Company|array $company,
        ?float $sentiment = null,
        ?string $snippet = null,
        ?string $snippetEn = null,
    ): self {
        $self = new self;

        $self['categories'] = $categories;
        $self['company'] = $company;

        null !== $sentiment && $self['sentiment'] = $sentiment;
        null !== $snippet && $self['snippet'] = $snippet;
        null !== $snippetEn && $self['snippetEn'] = $snippetEn;

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
     * ### News Company.
     *
     * Company information when associated with news articles. Includes DUNS numbers and an
     * optional customer reference.
     *
     * @param Company|CompanyShape $company
     */
    public function withCompany(Company|array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    public function withSentiment(?float $sentiment): self
    {
        $self = clone $this;
        $self['sentiment'] = $sentiment;

        return $self;
    }

    public function withSnippet(?string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    public function withSnippetEn(?string $snippetEn): self
    {
        $self = clone $this;
        $self['snippetEn'] = $snippetEn;

        return $self;
    }
}
