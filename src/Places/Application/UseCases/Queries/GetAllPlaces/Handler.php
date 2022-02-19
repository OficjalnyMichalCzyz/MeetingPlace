<?php


namespace MeetingPlace\Places\Application\UseCases\Queries\GetAllPlaces;

use MeetingPlace\Places\Domain\Place;
use MeetingPlace\Places\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as PlaceRepository;

class Handler
{
    private PlaceRepository $placeRepository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * @param Query|null $query
     * @return Place[]
     */
    public function handle(?Query $query): array
    {
        if ($query === null) {
            return $this->placeRepository->getAll();
        }

        return $this->placeRepository->getAllWithGroup($query->getGroup());
    }
}