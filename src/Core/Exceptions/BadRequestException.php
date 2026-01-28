<?php

namespace Businessradar\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Bad Request Exception';
}
