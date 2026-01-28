<?php

namespace Businessradar\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Rate Limit Exception';
}
