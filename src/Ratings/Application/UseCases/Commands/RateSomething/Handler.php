<?php


namespace MeetingPlace\Ratings\Application\UseCases\Commands\RateSomething;

use MeetingPlace\Ratings\Domain\Rating;
use MeetingPlace\Ratings\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as RatingsRepository;

class Handler
{
    private RatingsRepository $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepository)
    {
        $this->ratingsRepository = $ratingsRepository;
    }

    public function handle(Command $command): Rating
    {
        $rating = new Rating(
            null,
            $command->getAddedFromIp(),
            new \DateTimeImmutable(),
            $command->getDescription(),
            false,
            $command->getType(),
            $command->getPlaceId(),
            $command->getRatingId(),
            $command->isComment()
        );
        $this->ratingsRepository->addNew($rating);
        return $rating;
    }
}