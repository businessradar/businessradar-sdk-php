<?php

declare(strict_types=1);

namespace Businessradar\Core\Conversion;

use Businessradar\Core\Conversion\Concerns\ArrayOf;
use Businessradar\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
