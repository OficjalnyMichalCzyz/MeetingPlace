<?php

namespace MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace;

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

    public function create(array $data): Command
    {
        $this->schemaValidator->validate($data);

        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $creationDate = new \DateTime();
        $description = $data['description'];
        $firstImageUrl = $data['firstImageUrl'];
        $secondImageUrl = $data['secondImageUrl'];
        $thirdImageUrl = $data['thirdImageUrl'];
        $group = $data['group'];
        $originIp = new OriginIp($this->clientIpAddressProvider->getClientIpAddressAsLong());
        return new Command(
            $latitude,
            $longitude,
            $originIp,
            $creationDate,
            $description,
            $firstImageUrl,
            $secondImageUrl,
            $thirdImageUrl,
            $group
        );
    }
}