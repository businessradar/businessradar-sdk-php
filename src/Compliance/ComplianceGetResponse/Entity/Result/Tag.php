<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse\Entity\Result;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Compliance entity result tag serializer.
 *
 * @phpstan-type TagShape = array{tag: string}
 */
final class Tag implements BaseModel
{
    /** @use SdkModel<TagShape> */
    use SdkModel;

    #[Required]
    public string $tag;

    /**
     * `new Tag()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Tag::with(tag: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Tag)->withTag(...)
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
    public static function with(string $tag): self
    {
        $self = new self;

        $self['tag'] = $tag;

        return $self;
    }

    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }
}
