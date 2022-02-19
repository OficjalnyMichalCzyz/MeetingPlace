<?php


namespace MeetingPlace\SharedKernel\Infrastructure\ClientIpAddressProvider;

interface ClientIpAddressProvider
{
    public function getClientIpAddressAsLong(): int;
}