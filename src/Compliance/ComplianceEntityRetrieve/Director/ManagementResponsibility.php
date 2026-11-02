<?php

declare(strict_types=1);

namespace Businessradar\Compliance\ComplianceEntityRetrieve\Director;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * @phpstan-type ManagementResponsibilityShape = array{
 *   description: string, mrcCode: string
 * }
 */
final class ManagementResponsibility implements BaseModel
{
    /** @use SdkModel<ManagementResponsibilityShape> */
    use SdkModel;

    #[Required]
    public string $description;

    #[Required]
    public string $mrcCode;

    /**
     * `new ManagementResponsibility()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ManagementResponsibility::with(description: ..., mrcCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ManagementResponsibility)->withDescription(...)->withMrcCode(...)
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
    public static function with(string $description, string $mrcCode): self
    {
        $self = new self;

        $self['description'] = $description;
        $self['mrcCode'] = $mrcCode;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withMrcCode(string $mrcCode): self
    {
        $self = clone $this;
        $self['mrcCode'] = $mrcCode;

        return $self;
    }
}
