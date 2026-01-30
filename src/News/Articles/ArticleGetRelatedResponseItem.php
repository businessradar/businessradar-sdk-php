<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Related Article.
 *
 * An article that is semantically related to another, including a distance score
 * indicating the degree of similarity.
 *
 * @phpstan-import-type ArticleShape from \Businessradar\News\Articles\Article
 *
 * @phpstan-type ArticleGetRelatedResponseItemShape = array{
 *   article: Article|ArticleShape, distance: float
 * }
 */
final class ArticleGetRelatedResponseItem implements BaseModel
{
    /** @use SdkModel<ArticleGetRelatedResponseItemShape> */
    use SdkModel;

    /**
     * ### Article.
     *
     * The primary data structure for news articles. It provides comprehensive data,
     * including: - Metadata (URLs, publication dates, languages, countries) - Content
     * (titles, snippets, summaries - both original and translated) - Relationships
     * (source, related companies, categories) - Analysis (sentiment, clustering status)
     */
    #[Required]
    public Article $article;

    #[Required]
    public float $distance;

    /**
     * `new ArticleGetRelatedResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleGetRelatedResponseItem::with(article: ..., distance: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleGetRelatedResponseItem)->withArticle(...)->withDistance(...)
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
     * @param Article|ArticleShape $article
     */
    public static function with(Article|array $article, float $distance): self
    {
        $self = new self;

        $self['article'] = $article;
        $self['distance'] = $distance;

        return $self;
    }

    /**
     * ### Article.
     *
     * The primary data structure for news articles. It provides comprehensive data,
     * including: - Metadata (URLs, publication dates, languages, countries) - Content
     * (titles, snippets, summaries - both original and translated) - Relationships
     * (source, related companies, categories) - Analysis (sentiment, clustering status)
     *
     * @param Article|ArticleShape $article
     */
    public function withArticle(Article|array $article): self
    {
        $self = clone $this;
        $self['article'] = $article;

        return $self;
    }

    public function withDistance(float $distance): self
    {
        $self = clone $this;
        $self['distance'] = $distance;

        return $self;
    }
}
