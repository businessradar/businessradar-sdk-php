<?php

declare(strict_types=1);

namespace Businessradar\News\Articles\Article;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Sub-Article.
 *
 * A lightweight representation of an article that is part of a larger cluster or
 * related to a main article.
 *
 * @phpstan-type SubArticleShape = array{url: string, externalID?: string|null}
 */
final class SubArticle implements BaseModel
{
    /** @use SdkModel<SubArticleShape> */
    use SdkModel;

    #[Required]
    public string $url;

    #[Optional('external_id')]
    public ?string $externalID;

    /**
     * `new SubArticle()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubArticle::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubArticle)->withURL(...)
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
    public static function with(string $url, ?string $externalID = null): self
    {
        $self = new self;

        $self['url'] = $url;

        null !== $externalID && $self['externalID'] = $externalID;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }
}
