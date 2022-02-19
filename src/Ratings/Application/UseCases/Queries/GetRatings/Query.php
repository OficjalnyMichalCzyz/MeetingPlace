<?php

namespace MeetingPlace\Ratings\Application\UseCases\Queries\GetRatings;

class Query
{
    private int $id;
    private bool $placeRating;

    /**
     * Query constructor.
     * @param int $id
     * @param bool $placeRating
     */
    public function __construct(int $id, bool $placeRating)
    {
        $this->id = $id;
        $this->placeRating = $placeRating;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isPlaceRating(): bool
    {
        return $this->placeRating;
    }
}