<?php

namespace MeetingPlace\Ratings\Domain;

use MeetingPlace\SharedKernel\Domain\OriginIp;

class Rating
{
    private ?int $id;
    private OriginIp $addedFromIp;
    private \DateTimeInterface $creationTime;
    private string $description;
    private bool $deleted;
    private Type $type;
    private ?int $placeId;
    private ?int $ratingId;
    private bool $isComment;

    public function __construct(?int $id, OriginIp $addedFromIp, \DateTimeInterface $creationTime, string $description, bool $deleted, Type $type, ?int $placeId, ?int $ratingId, bool $isComment)
    {
        $this->id = $id;
        $this->addedFromIp = $addedFromIp;
        $this->creationTime = $creationTime;
        $this->description = $description;
        $this->deleted = $deleted;
        $this->type = $type;
        $this->placeId = $placeId;
        $this->ratingId = $ratingId;
        $this->isComment = $isComment;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Rating
    {
        $this->id = $id;
        return $this;
    }

    public function getAddedFromIp(): OriginIp
    {
        return $this->addedFromIp;
    }

    public function setAddedFromIp(OriginIp $addedFromIp): Rating
    {
        $this->addedFromIp = $addedFromIp;
        return $this;
    }

    public function getCreationTime(): \DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(\DateTimeInterface $creationTime): Rating
    {
        $this->creationTime = $creationTime;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Rating
    {
        $this->description = $description;
        return $this;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): Rating
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): Rating
    {
        $this->type = $type;
        return $this;
    }

    public function getPlaceId(): ?int
    {
        return $this->placeId;
    }

    public function setPlaceId(?int $placeId): Rating
    {
        $this->placeId = $placeId;
        return $this;
    }

    public function getRatingId(): ?int
    {
        return $this->ratingId;
    }

    public function setRatingId(?int $ratingId): Rating
    {
        $this->ratingId = $ratingId;
        return $this;
    }

    public function isComment(): bool
    {
        return $this->isComment;
    }

    public function setIsComment(bool $isComment): Rating
    {
        $this->isComment = $isComment;
        return $this;
    }
}