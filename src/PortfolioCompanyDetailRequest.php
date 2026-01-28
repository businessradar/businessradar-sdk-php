<?php

declare(strict_types=1);

namespace Businessradar;

use Businessradar\Core\Attributes\Required;
use Businessradar\Core\Concerns\SdkModel;
use Businessradar\Core\Contracts\BaseModel;

/**
 * Portfolio Company Detail Serializer.
 *
 * Alternative serializer for the Company model which is limited.
 *
 * @phpstan-type PortfolioCompanyDetailRequestShape = array{externalID: string}
 */
final class PortfolioCompanyDetailRequest implements BaseModel
{
    /** @use SdkModel<PortfolioCompanyDetailRequestShape> */
    use SdkModel;

    #[Required('external_id')]
    public string $externalID;

    /**
     * `new PortfolioCompanyDetailRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PortfolioCompanyDetailRequest::with(externalID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PortfolioCompanyDetailRequest)->withExternalID(...)
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
