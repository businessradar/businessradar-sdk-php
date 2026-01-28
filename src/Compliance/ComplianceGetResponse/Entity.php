<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse;

use Businessradar\Compliance\ComplianceGetResponse\Entity\EntityRole;
use Businessradar\Compliance\ComplianceGetResponse\Entity\EntityType;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Result;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Ubo;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Result
 * @phpstan-import-type UboShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Ubo
 *
 * @phpstan-type EntityShape = array{
 *   entityRole: EntityRole|value-of<EntityRole>,
 *   entityType: EntityType|value-of<EntityType>,
 *   externalID: string,
 *   name: string,
 *   results: list<Result|ResultShape>,
 *   ubo: null|Ubo|UboShape,
 *   country?: string|null,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    /**
     * * `ubo` - Ultimate Beneficial Owner
     * * `director` - Director
     * * `company` - Company
     * * `manually_added` - Manually added.
     *
     * @var value-of<EntityRole> $entityRole
     */
    #[Required('entity_role', enum: EntityRole::class)]
    public string $entityRole;

    /**
     * * `individual` - Individual
     * * `company` - Company.
     *
     * @var value-of<EntityType> $entityType
     */
    #[Required('entity_type', enum: EntityType::class)]
    public string $entityType;

    #[Required('external_id')]
    public string $externalID;

    #[Required]
    public string $name;

    /** @var list<Result> $results */
    #[Required(list: Result::class)]
    public array $results;

    #[Required]
    public ?Ubo $ubo;

    #[Optional(nullable: true)]
    public ?string $country;

    /**
     * `new Entity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entity::with(
     *   entityRole: ...,
     *   entityType: ...,
     *   externalID: ...,
     *   name: ...,
     *   results: ...,
     *   ubo: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entity)
     *   ->withEntityRole(...)
     *   ->withEntityType(...)
     *   ->withExternalID(...)
     *   ->withName(...)
     *   ->withResults(...)
     *   ->withUbo(...)
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
     * @param EntityRole|value-of<EntityRole> $entityRole
     * @param EntityType|value-of<EntityType> $entityType
     * @param list<Result|ResultShape> $results
     * @param Ubo|UboShape|null $ubo
     */
    public static function with(
        EntityRole|string $entityRole,
        EntityType|string $entityType,
        string $externalID,
        string $name,
        array $results,
        Ubo|array|null $ubo,
        ?string $country = null,
    ): self {
        $self = new self;

        $self['entityRole'] = $entityRole;
        $self['entityType'] = $entityType;
        $self['externalID'] = $externalID;
        $self['name'] = $name;
        $self['results'] = $results;
        $self['ubo'] = $ubo;

        null !== $country && $self['country'] = $country;

        return $self;
    }

    /**
     * * `ubo` - Ultimate Beneficial Owner
     * * `director` - Director
     * * `company` - Company
     * * `manually_added` - Manually added.
     *
     * @param EntityRole|value-of<EntityRole> $entityRole
     */
    public function withEntityRole(EntityRole|string $entityRole): self
    {
        $self = clone $this;
        $self['entityRole'] = $entityRole;

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

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * @param Ubo|UboShape|null $ubo
     */
    public function withUbo(Ubo|array|null $ubo): self
    {
        $self = clone $this;
        $self['ubo'] = $ubo;

        return $self;
    }

    public function withCountry(?string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }
}
