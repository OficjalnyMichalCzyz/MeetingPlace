<?php

namespace MeetingPlace\Ratings\Domain\Exceptions;

use MeetingPlace\SharedKernel\Domain\Exceptions\ValidationError;

class AlreadyRated extends ValidationError
{
    public static function create(int $originIpWhichAlreadyRated): self
    {
        return new self(\sprintf("'%s' has already rated!", (string)$originIpWhichAlreadyRated));
    }
}