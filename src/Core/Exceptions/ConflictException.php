<?php

namespace Businessradar\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Conflict Exception';
}
