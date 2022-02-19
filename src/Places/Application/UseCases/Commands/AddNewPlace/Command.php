<?php

namespace MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace;

use DateTimeInterface;
use MeetingPlace\SharedKernel\Domain\OriginIp;

class Command
{
    private string $latitude;
    private string $longitude;
    private OriginIp $addedFromIp;
    private DateTimeInterface $creationDate;
    private string $description;
    private string $firstImageUrl;
    private string $secondImageUrl;
    private string $thirdImageUrl;
    private string $group;

    public function __construct(
        string $latitude,
        string $longitude,
        OriginIp $addedFromIp,
        DateTimeInterface $creationDate,
        string $description,
        string $firstImageUrl,
        string $secondImageUrl,
        string $thirdImageUrl,
        string $group
    )
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->addedFromIp = $addedFromIp;
        $this->creationDate = $creationDate;
        $this->description = $description;
        $this->firstImageUrl = $firstImageUrl;
        $this->secondImageUrl = $secondImageUrl;
        $this->thirdImageUrl = $thirdImageUrl;
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @return OriginIp
     */
    public function getAddedFromIp(): OriginIp
    {
        return $this->addedFromIp;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreationDate(): DateTimeInterface
    {
        return $this->creationDate;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getFirstImageUrl(): string
    {
        return $this->firstImageUrl;
    }

    /**
     * @return string
     */
    public function getSecondImageUrl(): string
    {
        return $this->secondImageUrl;
    }

    /**
     * @return string
     */
    public function getThirdImageUrl(): string
    {
        return $this->thirdImageUrl;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }
}