<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Saved Article Filters.
 *
 * Retrieve a list of all search filters saved by the current profile. These filters
 * can be applied to article search requests using the `saved_article_filter_id`
 * parameter.
 *
 * @see Businessradar\Services\News\ArticlesService::listSavedArticleFilters()
 *
 * @phpstan-type ArticleListSavedArticleFiltersParamsShape = array{
 *   nextKey?: string|null
 * }
 */
final class ArticleListSavedArticleFiltersParams implements BaseModel
{
    /** @use SdkModel<ArticleListSavedArticleFiltersParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor value used for pagination. Include the `next_key` value from your previous request to retrieve the subsequent page of results. If this value is `null`, the first page of results is returned.
     */
    #[Optional]
    public ?string $nextKey;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $nextKey = null): self
    {
        $self = new self;

        null !== $nextKey && $self['nextKey'] = $nextKey;

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
}
