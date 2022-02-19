<?php

namespace MeetingPlace\Ratings\Application\UseCases\Commands\RateSomething;

use MeetingPlace\Ratings\Domain\Type;
use MeetingPlace\SharedKernel\Domain\OriginIp;

class Command
{
    private OriginIp $addedFromIp;
    private \DateTimeInterface $creationTime;
    private string $description;
    private Type $type;
    private ?int $placeId;
    private ?int $ratingId;
    private bool $isComment;

    public function __construct(OriginIp $addedFromIp, \DateTimeInterface $creationTime, string $description, Type $type, ?int $placeId, ?int $ratingId, bool $isComment)
    {
        $this->addedFromIp = $addedFromIp;
        $this->creationTime = $creationTime;
        $this->description = $description;
        $this->type = $type;
        $this->placeId = $placeId;
        $this->ratingId = $ratingId;
        $this->isComment = $isComment;
    }

    /**
     * @return OriginIp
     */
    public function getAddedFromIp(): OriginIp
    {
        return $this->addedFromIp;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreationTime(): \DateTimeInterface
    {
        return $this->creationTime;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getPlaceId(): ?int
    {
        return $this->placeId;
    }

    /**
     * @return int|null
     */
    public function getRatingId(): ?int
    {
        return $this->ratingId;
    }

    /**
     * @return bool
     */
    public function isComment(): bool
    {
        return $this->isComment;
    }
}