<?php

namespace MeetingPlace\Ratings\Application\UseCases\Queries\GetRatings;

use MeetingPlace\Ratings\Domain\Rating;
use MeetingPlace\Ratings\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as RatingsRepository;

class Handler
{
    private RatingsRepository $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepository)
    {
        $this->ratingsRepository = $ratingsRepository;
    }

    /**
     * @param Query $query
     * @return Rating[]
     */
    public function handle(Query $query): array
    {
        if ($query->isPlaceRating()) {
            return $this->ratingsRepository->getAllByPlaceId($query->getId());
        }

        return $this->ratingsRepository->getAllByRatingId($query->getId());
    }
}