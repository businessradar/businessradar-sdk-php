<?php

namespace Businessradar\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Not Found Exception';
}
