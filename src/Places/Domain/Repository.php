<?php

namespace MeetingPlace\Places\Domain;

abstract class Repository
{
    abstract public function getAllWithGroup(string $group): array;

    abstract public function getAll(): array;

    public function addNew(Place $place): void
    {
        $this->persist($place);
    }

    abstract protected function persist(Place $place): void;
}