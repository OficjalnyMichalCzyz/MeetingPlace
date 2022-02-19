<?php

namespace MeetingPlace\SharedKernel\Application\AddNewPlace\Exceptions;

use MeetingPlace\SharedKernel\Domain\Exceptions\ValidationError;

class ParameterInvalid extends ValidationError
{
    public static function create(string $parameterValue, string $parameterName): self
    {
        return new self(\sprintf("'%s' is invalid %s!", $parameterValue, $parameterName));
    }
}