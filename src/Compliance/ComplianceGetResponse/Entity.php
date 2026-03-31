<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceGetResponse;

use Businessradar\Compliance\ComplianceGetResponse\Entity\EntityType;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Gender;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Status;
use Businessradar\Compliance\ComplianceGetResponse\Entity\Ubo;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type UboShape from \Businessradar\Compliance\ComplianceGetResponse\Entity\Ubo
 *
 * @phpstan-type EntityShape = array{
 *   adverseMediaMonitoringEnabled: bool,
 *   aliases: list<string>,
 *   entityRole: string,
 *   entityType: EntityType|value-of<EntityType>,
 *   externalID: string,
 *   name: string,
 *   sanctionMonitoringEnabled: bool,
 *   status: \Businessradar\Compliance\ComplianceGetResponse\Entity\Status|value-of<\Businessradar\Compliance\ComplianceGetResponse\Entity\Status>,
 *   ubo: null|Ubo|UboShape,
 *   country?: string|null,
 *   gender?: null|Gender|value-of<Gender>,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    #[Required('adverse_media_monitoring_enabled')]
    public bool $adverseMediaMonitoringEnabled;

    /** @var list<string> $aliases */
    #[Required(list: 'string')]
    public array $aliases;

    #[Required('entity_role')]
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

    #[Required('sanction_monitoring_enabled')]
    public bool $sanctionMonitoringEnabled;

    /**
     * * `on_hold` - On Hold
     * * `queued` - Queued
     * * `in_progress` - In Progress
     * * `completed` - Completed
     * * `skipped` - Skipped
     * * `failed` - Failed.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class
    )]
    public string $status;

    #[Required]
    public ?Ubo $ubo;

    #[Optional(nullable: true)]
    public ?string $country;

    /** @var value-of<Gender>|null $gender */
    #[Optional(enum: Gender::class, nullable: true)]
    public ?string $gender;

    /**
     * `new Entity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entity::with(
     *   adverseMediaMonitoringEnabled: ...,
     *   aliases: ...,
     *   entityRole: ...,
     *   entityType: ...,
     *   externalID: ...,
     *   name: ...,
     *   sanctionMonitoringEnabled: ...,
     *   status: ...,
     *   ubo: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entity)
     *   ->withAdverseMediaMonitoringEnabled(...)
     *   ->withAliases(...)
     *   ->withEntityRole(...)
     *   ->withEntityType(...)
     *   ->withExternalID(...)
     *   ->withName(...)
     *   ->withSanctionMonitoringEnabled(...)
     *   ->withStatus(...)
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
     * @param list<string> $aliases
     * @param EntityType|value-of<EntityType> $entityType
     * @param Status|value-of<Status> $status
     * @param Ubo|UboShape|null $ubo
     * @param Gender|value-of<Gender>|null $gender
     */
    public static function with(
        bool $adverseMediaMonitoringEnabled,
        array $aliases,
        string $entityRole,
        EntityType|string $entityType,
        string $externalID,
        string $name,
        bool $sanctionMonitoringEnabled,
        Status|string $status,
        Ubo|array|null $ubo,
        ?string $country = null,
        Gender|string|null $gender = null,
    ): self {
        $self = new self;

        $self['adverseMediaMonitoringEnabled'] = $adverseMediaMonitoringEnabled;
        $self['aliases'] = $aliases;
        $self['entityRole'] = $entityRole;
        $self['entityType'] = $entityType;
        $self['externalID'] = $externalID;
        $self['name'] = $name;
        $self['sanctionMonitoringEnabled'] = $sanctionMonitoringEnabled;
        $self['status'] = $status;
        $self['ubo'] = $ubo;

        null !== $country && $self['country'] = $country;
        null !== $gender && $self['gender'] = $gender;

        return $self;
    }

    public function withAdverseMediaMonitoringEnabled(
        bool $adverseMediaMonitoringEnabled
    ): self {
        $self = clone $this;
        $self['adverseMediaMonitoringEnabled'] = $adverseMediaMonitoringEnabled;

        return $self;
    }

    /**
     * @param list<string> $aliases
     */
    public function withAliases(array $aliases): self
    {
        $self = clone $this;
        $self['aliases'] = $aliases;

        return $self;
    }

    public function withEntityRole(string $entityRole): self
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

    public function withSanctionMonitoringEnabled(
        bool $sanctionMonitoringEnabled
    ): self {
        $self = clone $this;
        $self['sanctionMonitoringEnabled'] = $sanctionMonitoringEnabled;

        return $self;
    }

    /**
     * * `on_hold` - On Hold
     * * `queued` - Queued
     * * `in_progress` - In Progress
     * * `completed` - Completed
     * * `skipped` - Skipped
     * * `failed` - Failed.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

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

    /**
     * @param Gender|value-of<Gender>|null $gender
     */
    public function withGender(Gender|string|null $gender): self
    {
        $self = clone $this;
        $self['gender'] = $gender;

        return $self;
    }
}
