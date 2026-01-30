<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceListResultsResponse;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Compliance entity result source serializer.
 *
 * @phpstan-type SourceShape = array{
 *   url: string,
 *   description?: string|null,
 *   document?: string|null,
 *   domain?: string|null,
 *   publicationDate?: string|null,
 *   title?: string|null,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    #[Required]
    public string $url;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $document;

    #[Optional(nullable: true)]
    public ?string $domain;

    #[Optional('publication_date', nullable: true)]
    public ?string $publicationDate;

    #[Optional(nullable: true)]
    public ?string $title;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Source)->withURL(...)
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
    public static function with(
        string $url,
        ?string $description = null,
        ?string $document = null,
        ?string $domain = null,
        ?string $publicationDate = null,
        ?string $title = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $description && $self['description'] = $description;
        null !== $document && $self['document'] = $document;
        null !== $domain && $self['domain'] = $domain;
        null !== $publicationDate && $self['publicationDate'] = $publicationDate;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDocument(?string $document): self
    {
        $self = clone $this;
        $self['document'] = $document;

        return $self;
    }

    public function withDomain(?string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    public function withPublicationDate(?string $publicationDate): self
    {
        $self = clone $this;
        $self['publicationDate'] = $publicationDate;

        return $self;
    }

    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
