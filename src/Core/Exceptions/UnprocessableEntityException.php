<?php

namespace Businessradar\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Unprocessable Entity Exception';
}
