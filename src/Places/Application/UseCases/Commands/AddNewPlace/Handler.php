<?php


namespace MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace;

use MeetingPlace\Places\Domain\Place;
use MeetingPlace\Places\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as PlaceRepository;

class Handler
{
    private PlaceRepository $placeRepository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function handle(Command $command): Place
    {
        $place = new Place(
            null,
            $command->getLatitude(),
            $command->getLongitude(),
            $command->getAddedFromIp(),
            $command->getCreationDate(),
            $command->getDescription(),
            $command->getFirstImageUrl(),
            $command->getSecondImageUrl(),
            $command->getThirdImageUrl(),
            false,
            $command->getGroup()
        );
        $this->placeRepository->addNew($place);
        return $place;
    }
}