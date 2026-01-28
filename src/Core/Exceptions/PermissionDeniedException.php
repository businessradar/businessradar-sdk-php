<?php

namespace Businessradar\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Businessradar Permission Denied Exception';
}
