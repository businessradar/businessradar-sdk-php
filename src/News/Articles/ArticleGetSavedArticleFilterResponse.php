<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\News\Articles\Export\ArticleFilters;

/**
 * ### Saved Article Filter Detail.
 *
 * A saved article filter with the filters it applies, in the same format as the
 * `filters` of an article export. Article search parameters such as `category`
 * replace the matching saved filter values.
 *
 * @phpstan-import-type ArticleFiltersShape from \Businessradar\News\Articles\Export\ArticleFilters
 *
 * @phpstan-type ArticleGetSavedArticleFilterResponseShape = array{
 *   externalID: string, filters: ArticleFilters|ArticleFiltersShape, name: string
 * }
 */
final class ArticleGetSavedArticleFilterResponse implements BaseModel
{
    /** @use SdkModel<ArticleGetSavedArticleFilterResponseShape> */
    use SdkModel;

    #[Required('external_id')]
    public string $externalID;

    /**
     * ### Article Filters.
     *
     * Used to validate and process filters for article searches. Supports filtering by
     * query text, countries, languages, specific companies (DUNS), and portfolios.
     */
    #[Required]
    public ArticleFilters $filters;

    #[Required]
    public string $name;

    /**
     * `new ArticleGetSavedArticleFilterResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleGetSavedArticleFilterResponse::with(
     *   externalID: ..., filters: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleGetSavedArticleFilterResponse)
     *   ->withExternalID(...)
     *   ->withFilters(...)
     *   ->withName(...)
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
     * @param ArticleFilters|ArticleFiltersShape $filters
     */
    public static function with(
        string $externalID,
        ArticleFilters|array $filters,
        string $name
    ): self {
        $self = new self;

        $self['externalID'] = $externalID;
        $self['filters'] = $filters;
        $self['name'] = $name;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * ### Article Filters.
     *
     * Used to validate and process filters for article searches. Supports filtering by
     * query text, countries, languages, specific companies (DUNS), and portfolios.
     *
     * @param ArticleFilters|ArticleFiltersShape $filters
     */
    public function withFilters(ArticleFilters|array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
