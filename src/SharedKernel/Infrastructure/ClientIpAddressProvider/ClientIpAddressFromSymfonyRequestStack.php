<?php

namespace MeetingPlace\SharedKernel\Infrastructure\ClientIpAddressProvider;

use Symfony\Component\HttpFoundation\RequestStack;

class ClientIpAddressFromSymfonyRequestStack implements ClientIpAddressProvider
{
    private null|string $clientIpAddress;

    /**
     * ClientIpAddressFromSymfonyRequestStack constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        // TODO: Implement exceptions
        $this->clientIpAddress = $requestStack->getCurrentRequest()->getClientIp();
    }

    /**
     * @return int
     */
    public function getClientIpAddressAsLong(): int
    {
        return ip2long($this->clientIpAddress);
    }
}