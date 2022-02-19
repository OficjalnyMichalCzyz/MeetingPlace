<?php

namespace MeetingPlace\Places\Domain;

use DateTimeInterface;
use MeetingPlace\SharedKernel\Domain\OriginIp;

class Place
{
    private ?int $id;
    private string $latitude;
    private string $longitude;
    private OriginIp $addedFromIp;
    private DateTimeInterface $creationDate;
    private string $description;
    private string $firstImageUrl;
    private string $secondImageUrl;
    private string $thirdImageUrl;
    private bool $deleted;
    private string $group;

    public function __construct(
        ?int $id,
        string $latitude,
        string $longitude,
        OriginIp $addedFromIp,
        DateTimeInterface $creationDate,
        string $description,
        string $firstImageUrl,
        string $secondImageUrl,
        string $thirdImageUrl,
        bool $deleted,
        string $group
    )
    {
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->addedFromIp = $addedFromIp;
        $this->creationDate = $creationDate;
        $this->description = $description;
        $this->firstImageUrl = $firstImageUrl;
        $this->secondImageUrl = $secondImageUrl;
        $this->thirdImageUrl = $thirdImageUrl;
        $this->deleted = $deleted;
        $this->group = $group;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Place
    {
        $this->id = $id;
        return $this;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): Place
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): Place
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getAddedFromIp(): OriginIp
    {
        return $this->addedFromIp;
    }

    public function setAddedFromIp(OriginIp $addedFromIp): Place
    {
        $this->addedFromIp = $addedFromIp;
        return $this;
    }

    public function getCreationDate(): DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): Place
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Place
    {
        $this->description = $description;
        return $this;
    }

    public function getFirstImageUrl(): string
    {
        return $this->firstImageUrl;
    }

    public function setFirstImageUrl(string $firstImageUrl): Place
    {
        $this->firstImageUrl = $firstImageUrl;
        return $this;
    }

    public function getSecondImageUrl(): string
    {
        return $this->secondImageUrl;
    }

    public function setSecondImageUrl(string $secondImageUrl): Place
    {
        $this->secondImageUrl = $secondImageUrl;
        return $this;
    }

    public function getThirdImageUrl(): string
    {
        return $this->thirdImageUrl;
    }

    public function setThirdImageUrl(string $thirdImageUrl): Place
    {
        $this->thirdImageUrl = $thirdImageUrl;
        return $this;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): Place
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): Place
    {
        $this->group = $group;
        return $this;
    }
}