<?php

namespace Businessradar\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Authentication Exception';
}
