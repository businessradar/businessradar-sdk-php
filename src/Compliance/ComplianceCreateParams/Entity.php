<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceCreateParams;

use Businessradar\Compliance\ComplianceCreateParams\Entity\EntityType;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * ### Compliance Entity Request.
 *
 * Represents an entity (individual or organization) to be included in a compliance
 * screening.
 *
 * @phpstan-type EntityShape = array{
 *   name: string,
 *   aliases?: list<string>|null,
 *   country?: string|null,
 *   dateOfBirth?: string|null,
 *   entityType?: null|EntityType|value-of<EntityType>,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   middleName?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    #[Required]
    public string $name;

    /**
     * Alternative names or aliases for the compliance entity.
     *
     * @var list<string>|null $aliases
     */
    #[Optional(list: 'string')]
    public ?array $aliases;

    #[Optional(nullable: true)]
    public ?string $country;

    /**
     * Date of birth. Accepts a full or partial date in YYYY, YYYY-MM or YYYY-MM-DD format (e.g. when only the year is known).
     */
    #[Optional('date_of_birth', nullable: true)]
    public ?string $dateOfBirth;

    /**
     * * `individual` - Individual
     * * `company` - Company.
     *
     * @var value-of<EntityType>|null $entityType
     */
    #[Optional('entity_type', enum: EntityType::class)]
    public ?string $entityType;

    #[Optional('first_name', nullable: true)]
    public ?string $firstName;

    #[Optional('last_name', nullable: true)]
    public ?string $lastName;

    #[Optional('middle_name', nullable: true)]
    public ?string $middleName;

    /**
     * `new Entity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entity::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entity)->withName(...)
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
     * @param list<string>|null $aliases
     * @param EntityType|value-of<EntityType>|null $entityType
     */
    public static function with(
        string $name,
        ?array $aliases = null,
        ?string $country = null,
        ?string $dateOfBirth = null,
        EntityType|string|null $entityType = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $middleName = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $aliases && $self['aliases'] = $aliases;
        null !== $country && $self['country'] = $country;
        null !== $dateOfBirth && $self['dateOfBirth'] = $dateOfBirth;
        null !== $entityType && $self['entityType'] = $entityType;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $middleName && $self['middleName'] = $middleName;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Alternative names or aliases for the compliance entity.
     *
     * @param list<string> $aliases
     */
    public function withAliases(array $aliases): self
    {
        $self = clone $this;
        $self['aliases'] = $aliases;

        return $self;
    }

    public function withCountry(?string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Date of birth. Accepts a full or partial date in YYYY, YYYY-MM or YYYY-MM-DD format (e.g. when only the year is known).
     */
    public function withDateOfBirth(?string $dateOfBirth): self
    {
        $self = clone $this;
        $self['dateOfBirth'] = $dateOfBirth;

        return $self;
    }

    /**
     * * `individual` - Individual
     * * `company` - Company.
     *
     * @param EntityType|value-of<EntityType> $entityType
     */
    public function withEntityType(EntityType|string $entityType): self
    {
        $self = clone $this;
        $self['entityType'] = $entityType;

        return $self;
    }

    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    public function withMiddleName(?string $middleName): self
    {
        $self = clone $this;
        $self['middleName'] = $middleName;

        return $self;
    }
}
