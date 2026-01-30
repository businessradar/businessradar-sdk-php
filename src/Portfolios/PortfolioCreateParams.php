<?php

declare(strict_types=1);

namespace Businessradar\Portfolios;

use Businessradar\Core\Attributes\Optional;
use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Concerns\SdkParams;
use Businessradar\Core\Contracts\BaseModel;
use Businessradar\Portfolios\PortfolioCreateParams\DefaultPermission;

/**
 * ### Portfolios.
 *
 * Manage collections of companies. This view allows you to list existing portfolios
 * associated with your profile or create new ones.
 *
 * @see Businessradar\Services\PortfoliosService::create()
 *
 * @phpstan-type PortfolioCreateParamsShape = array{
 *   name: string,
 *   customerReference?: string|null,
 *   defaultPermission?: null|DefaultPermission|value-of<DefaultPermission>,
 * }
 */
final class PortfolioCreateParams implements BaseModel
{
    /** @use SdkModel<PortfolioCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    /**
     * Customer reference for the client to understand relationship.
     */
    #[Optional('customer_reference', nullable: true)]
    public ?string $customerReference;

    /**
     * Default permission for all users in organization.
     *
     * * `view_only` - Only Viewing Access
     * * `write` - View and Write Access
     * * `admin` - View, Write and Admin Access
     * * `owner` - Portfolio Owner
     *
     * @var value-of<DefaultPermission>|null $defaultPermission
     */
    #[Optional(
        'default_permission',
        enum: DefaultPermission::class,
        nullable: true
    )]
    public ?string $defaultPermission;

    /**
     * `new PortfolioCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PortfolioCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PortfolioCreateParams)->withName(...)
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
     * @param DefaultPermission|value-of<DefaultPermission>|null $defaultPermission
     */
    public static function with(
        string $name,
        ?string $customerReference = null,
        DefaultPermission|string|null $defaultPermission = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $customerReference && $self['customerReference'] = $customerReference;
        null !== $defaultPermission && $self['defaultPermission'] = $defaultPermission;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Customer reference for the client to understand relationship.
     */
    public function withCustomerReference(?string $customerReference): self
    {
        $self = clone $this;
        $self['customerReference'] = $customerReference;

        return $self;
    }

    /**
     * Default permission for all users in organization.
     *
     * * `view_only` - Only Viewing Access
     * * `write` - View and Write Access
     * * `admin` - View, Write and Admin Access
     * * `owner` - Portfolio Owner
     *
     * @param DefaultPermission|value-of<DefaultPermission>|null $defaultPermission
     */
    public function withDefaultPermission(
        DefaultPermission|string|null $defaultPermission
    ): self {
        $self = clone $this;
        $self['defaultPermission'] = $defaultPermission;

        return $self;
    }
}
