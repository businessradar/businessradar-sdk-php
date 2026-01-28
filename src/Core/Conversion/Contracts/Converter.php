<?php

declare(strict_types=1);

namespace Businessradar\Core\Conversion\Contracts;

use Businessradar\Core\Conversion\CoerceState;
use Businessradar\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
