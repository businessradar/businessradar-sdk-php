<?php

namespace Businessradar\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Internal Server Exception';
}
