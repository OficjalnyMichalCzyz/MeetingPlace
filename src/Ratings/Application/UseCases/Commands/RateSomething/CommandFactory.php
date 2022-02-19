<?php

namespace MeetingPlace\Ratings\Application\UseCases\Commands\RateSomething;

use MeetingPlace\Ratings\Domain\Type;
use MeetingPlace\SharedKernel\Domain\OriginIp;
use MeetingPlace\SharedKernel\Infrastructure\ClientIpAddressProvider\ClientIpAddressProvider;

class CommandFactory
{
    private SchemaValidator $schemaValidator;

    private ClientIpAddressProvider $clientIpAddressProvider;

    public function __construct(
        SchemaValidator $schemaValidator,
        ClientIpAddressProvider $clientIpAddressProvider
    )
    {
        $this->schemaValidator = $schemaValidator;
        $this->clientIpAddressProvider = $clientIpAddressProvider;
    }

    /**
     * @param array $data
     * @return Command
     * @throws \MeetingPlace\Ratings\Domain\Exceptions\TypeValueInvalid
     * @throws \MeetingPlace\SharedKernel\Application\Exceptions\SchemaError
     * @throws \MeetingPlace\SharedKernel\Domain\Exceptions\OriginIpInvalid
     */
    public function create(array $data): Command
    {
        $this->schemaValidator->validate($data);

        $addedFromIp = new OriginIp($this->clientIpAddressProvider->getClientIpAddressAsLong());
        $creationTime = new \DateTimeImmutable();
        $description = $data["body"] ?? '';
        $type = new Type($data["type"]);
        $placeId = $data["placeId"];
        $ratingId = $data["ratingId"];
        $isComment = $data["isComment"];

        return new Command(
            $addedFromIp,
            $creationTime,
            $description,
            $type,
            $placeId,
            $ratingId,
            $isComment
        );
    }
}