<?php

declare(strict_types=1);

namespace Businessradar\Compliance;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Compliance check create serializer.
 *
 * @phpstan-type ComplianceNewResponseShape = array{externalID: string}
 */
final class ComplianceNewResponse implements BaseModel
{
    /** @use SdkModel<ComplianceNewResponseShape> */
    use SdkModel;

    #[Required('external_id')]
    public string $externalID;

    /**
     * `new ComplianceNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ComplianceNewResponse::with(externalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ComplianceNewResponse)->withExternalID(...)
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
    public static function with(string $externalID): self
    {
        $self = new self;

        $self['externalID'] = $externalID;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }
}
