<?php

declare(strict_types=1);

namespace Businessradar\News\Articles;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Category Tree Structure.
 *
 * @phpstan-type CategoryTreeShape = array{
 *   isMaterial: bool,
 *   name: string,
 *   subCategories: list<mixed>,
 *   externalID?: string|null,
 *   priority?: int|null,
 * }
 */
final class CategoryTree implements BaseModel
{
    /** @use SdkModel<CategoryTreeShape> */
    use SdkModel;

    /**
     * Return is_material flag if present.
     */
    #[Required('is_material')]
    public bool $isMaterial;

    #[Required]
    public string $name;

    /** @var list<mixed> $subCategories */
    #[Required('sub_categories', list: CategoryTree::class)]
    public array $subCategories;

    #[Optional('external_id')]
    public ?string $externalID;

    #[Optional(nullable: true)]
    public ?int $priority;

    /**
     * `new CategoryTree()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CategoryTree::with(isMaterial: ..., name: ..., subCategories: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CategoryTree)->withIsMaterial(...)->withName(...)->withSubCategories(...)
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
     * @param list<mixed> $subCategories
     */
    public static function with(
        bool $isMaterial,
        string $name,
        array $subCategories,
        ?string $externalID = null,
        ?int $priority = null,
    ): self {
        $self = new self;

        $self['isMaterial'] = $isMaterial;
        $self['name'] = $name;
        $self['subCategories'] = $subCategories;

        null !== $externalID && $self['externalID'] = $externalID;
        null !== $priority && $self['priority'] = $priority;

        return $self;
    }

    /**
     * Return is_material flag if present.
     */
    public function withIsMaterial(bool $isMaterial): self
    {
        $self = clone $this;
        $self['isMaterial'] = $isMaterial;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param list<mixed> $subCategories
     */
    public function withSubCategories(array $subCategories): self
    {
        $self = clone $this;
        $self['subCategories'] = $subCategories;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withPriority(?int $priority): self
    {
        $self = clone $this;
        $self['priority'] = $priority;

        return $self;
    }
}
