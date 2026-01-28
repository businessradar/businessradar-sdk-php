<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Related Article Serializer.
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
     * Custom Serializer for the Article Model.
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
     * Custom Serializer for the Article Model.
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
