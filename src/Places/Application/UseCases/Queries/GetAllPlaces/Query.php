<?php

namespace MeetingPlace\Places\Application\UseCases\Queries\GetAllPlaces;

class Query
{
    private string $group;

    public function __construct(string $group)
    {
        $this->group = $group;
    }

    public function getGroup(): string
    {
        return $this->group;
    }
}