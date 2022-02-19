<?php

namespace MeetingPlace\SharedKernel\Domain;

use MeetingPlace\SharedKernel\Domain\Exceptions\OriginIpInvalid;

class OriginIp
{
    private const MAX_ADMISSIBLE_LONG_IP = 4294967294;
    private const MIN_ADMISSIBLE_LONG_IP = 1;

    private int $originIp;

    /**
     * OriginIp constructor.
     * @param string $originIp
     * @throws OriginIpInvalid
     */
    public function __construct(string $originIp)
    {
        $this->isValid($originIp);
        $this->originIp = $originIp;
    }

    /**
     * @param string $originIp
     * @throws OriginIpInvalid
     */
    private function isValid(string $originIp)
    {
        $originIpLength = \mb_strlen((string)$originIp);
        if ($originIpLength > self::MAX_ADMISSIBLE_LONG_IP || $originIpLength < self::MIN_ADMISSIBLE_LONG_IP) {
            throw OriginIpInvalid::create($originIp);
        }
    }

    /**
     * @return int|string
     */
    public function originIp(): int|string
    {
        return $this->originIp;
    }


}