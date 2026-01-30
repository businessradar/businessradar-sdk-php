<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Saved Article Filter.
 *
 * Represents a named set of article search filters that can be reused.
 *
 * @phpstan-type ArticleListSavedArticleFiltersResponseShape = array{
 *   externalID: string, name: string
 * }
 */
final class ArticleListSavedArticleFiltersResponse implements BaseModel
{
    /** @use SdkModel<ArticleListSavedArticleFiltersResponseShape> */
    use SdkModel;

    #[Required('external_id')]
    public string $externalID;

    #[Required]
    public string $name;

    /**
     * `new ArticleListSavedArticleFiltersResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArticleListSavedArticleFiltersResponse::with(externalID: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArticleListSavedArticleFiltersResponse)->withExternalID(...)->withName(...)
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
     */
    public static function with(string $externalID, string $name): self
    {
        $self = new self;

        $self['externalID'] = $externalID;
        $self['name'] = $name;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
