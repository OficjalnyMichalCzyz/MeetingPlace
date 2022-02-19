<?php


namespace MeetingPlace\Ratings\Domain;


abstract class Repository
{
    /**
     * @param int $identifier
     * @return Rating[]
     */
    abstract public function getAllByPlaceId(int $identifier): array;

    /**
     * @param int $identifier
     * @return Rating[]
     */
    abstract public function getAllByRatingId(int $identifier): array;

    public function addNew(Rating $rating): void
    {
        $this->add($rating);
    }

    abstract protected function add(Rating $rating): void;
}