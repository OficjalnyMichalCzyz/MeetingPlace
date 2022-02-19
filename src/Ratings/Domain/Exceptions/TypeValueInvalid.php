<?php

namespace MeetingPlace\Ratings\Domain\Exceptions;

use MeetingPlace\SharedKernel\Domain\Exceptions\ValidationError;

class TypeValueInvalid extends ValidationError
{
    public static function create(int $invalidTypeValue): self
    {
        return new self(\sprintf("'%s' is invalid rating type!", (string)$invalidTypeValue));
    }
}