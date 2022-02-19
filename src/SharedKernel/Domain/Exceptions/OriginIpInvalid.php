<?php

namespace MeetingPlace\SharedKernel\Domain\Exceptions;

class OriginIpInvalid extends ValidationError
{
    public static function create(string $invalidOriginIp): self
    {
        return new self(\sprintf("'%s' is invalid originIP!", $invalidOriginIp));
    }
}