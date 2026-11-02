<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve;

use Businessradar\Compliance\ComplianceEntityRetrieve\Director\Gender;
use Businessradar\Compliance\ComplianceEntityRetrieve\Director\ManagementResponsibility;
use Businessradar\Compliance\ComplianceEntityRetrieve\Director\RoleGroup;
use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Custom Serializer for the Director Model.
 *
 * @phpstan-import-type ManagementResponsibilityShape from \Businessradar\Compliance\ComplianceEntityRetrieve\Director\ManagementResponsibility
 *
 * @phpstan-type DirectorShape = array{
 *   createdAt: \DateTimeInterface,
 *   fullName: string,
 *   managementResponsibilities: list<ManagementResponsibility|ManagementResponsibilityShape>,
 *   sourceName: string,
 *   updatedAt: \DateTimeInterface,
 *   externalID?: string|null,
 *   firstName?: string|null,
 *   gender?: null|\Businessradar\Compliance\ComplianceEntityRetrieve\Director\Gender|value-of<\Businessradar\Compliance\ComplianceEntityRetrieve\Director\Gender>,
 *   inactiveSince?: \DateTimeInterface|null,
 *   isMostSenior?: bool|null,
 *   lastName?: string|null,
 *   middleName?: string|null,
 *   roleGroup?: null|RoleGroup|value-of<RoleGroup>,
 *   title?: string|null,
 *   url?: string|null,
 * }
 */
final class Director implements BaseModel
{
    /** @use SdkModel<DirectorShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('full_name')]
    public string $fullName;

    /** @var list<ManagementResponsibility> $managementResponsibilities */
    #[Required(
        'management_responsibilities',
        list: ManagementResponsibility::class
    )]
    public array $managementResponsibilities;

    /**
     * Get Source Name.
     */
    #[Required('source_name')]
    public string $sourceName;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('external_id')]
    public ?string $externalID;

    #[Optional('first_name', nullable: true)]
    public ?string $firstName;

    /**
     * @var value-of<Gender>|null $gender
     */
    #[Optional(
        enum: Gender::class,
        nullable: true,
    )]
    public ?string $gender;

    /**
     * Indicate if the director is no longer active for this company.
     */
    #[Optional('inactive_since', nullable: true)]
    public ?\DateTimeInterface $inactiveSince;

    #[Optional('is_most_senior')]
    public ?bool $isMostSenior;

    #[Optional('last_name', nullable: true)]
    public ?string $lastName;

    #[Optional('middle_name', nullable: true)]
    public ?string $middleName;

    /**
     * * `BOARD` - Board
     * * `MANAGEMENT` - Management
     * * `OFFICER` - Officer / Signatory
     * * `OTHER` - Other.
     *
     * @var value-of<RoleGroup>|null $roleGroup
     */
    #[Optional('role_group', enum: RoleGroup::class)]
    public ?string $roleGroup;

    /**
     * Function title within this organization.
     */
    #[Optional(nullable: true)]
    public ?string $title;

    #[Optional(nullable: true)]
    public ?string $url;

    /**
     * `new Director()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Director::with(
     *   createdAt: ...,
     *   fullName: ...,
     *   managementResponsibilities: ...,
     *   sourceName: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Director)
     *   ->withCreatedAt(...)
     *   ->withFullName(...)
     *   ->withManagementResponsibilities(...)
     *   ->withSourceName(...)
     *   ->withUpdatedAt(...)
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
     * @param list<ManagementResponsibility|ManagementResponsibilityShape> $managementResponsibilities
     * @param Gender|value-of<Gender>|null $gender
     * @param RoleGroup|value-of<RoleGroup>|null $roleGroup
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $fullName,
        array $managementResponsibilities,
        string $sourceName,
        \DateTimeInterface $updatedAt,
        ?string $externalID = null,
        ?string $firstName = null,
        Gender|string|null $gender = null,
        ?\DateTimeInterface $inactiveSince = null,
        ?bool $isMostSenior = null,
        ?string $lastName = null,
        ?string $middleName = null,
        RoleGroup|string|null $roleGroup = null,
        ?string $title = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['fullName'] = $fullName;
        $self['managementResponsibilities'] = $managementResponsibilities;
        $self['sourceName'] = $sourceName;
        $self['updatedAt'] = $updatedAt;

        null !== $externalID && $self['externalID'] = $externalID;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $gender && $self['gender'] = $gender;
        null !== $inactiveSince && $self['inactiveSince'] = $inactiveSince;
        null !== $isMostSenior && $self['isMostSenior'] = $isMostSenior;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $middleName && $self['middleName'] = $middleName;
        null !== $roleGroup && $self['roleGroup'] = $roleGroup;
        null !== $title && $self['title'] = $title;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withFullName(string $fullName): self
    {
        $self = clone $this;
        $self['fullName'] = $fullName;

        return $self;
    }

    /**
     * @param list<ManagementResponsibility|ManagementResponsibilityShape> $managementResponsibilities
     */
    public function withManagementResponsibilities(
        array $managementResponsibilities
    ): self {
        $self = clone $this;
        $self['managementResponsibilities'] = $managementResponsibilities;

        return $self;
    }

    /**
     * Get Source Name.
     */
    public function withSourceName(string $sourceName): self
    {
        $self = clone $this;
        $self['sourceName'] = $sourceName;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * @param Gender|value-of<Gender>|null $gender
     */
    public function withGender(
        Gender|string|null $gender,
    ): self {
        $self = clone $this;
        $self['gender'] = $gender;

        return $self;
    }

    /**
     * Indicate if the director is no longer active for this company.
     */
    public function withInactiveSince(?\DateTimeInterface $inactiveSince): self
    {
        $self = clone $this;
        $self['inactiveSince'] = $inactiveSince;

        return $self;
    }

    public function withIsMostSenior(bool $isMostSenior): self
    {
        $self = clone $this;
        $self['isMostSenior'] = $isMostSenior;

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

    /**
     * * `BOARD` - Board
     * * `MANAGEMENT` - Management
     * * `OFFICER` - Officer / Signatory
     * * `OTHER` - Other.
     *
     * @param RoleGroup|value-of<RoleGroup> $roleGroup
     */
    public function withRoleGroup(RoleGroup|string $roleGroup): self
    {
        $self = clone $this;
        $self['roleGroup'] = $roleGroup;

        return $self;
    }

    /**
     * Function title within this organization.
     */
    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
