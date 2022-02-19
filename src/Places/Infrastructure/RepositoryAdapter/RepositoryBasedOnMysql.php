<?php

namespace MeetingPlace\Places\Infrastructure\RepositoryAdapter;

use Doctrine\DBAL\ParameterType;
use MeetingPlace\Places\Domain\Place;
use Doctrine\ORM\EntityManagerInterface;
use MeetingPlace\Places\Domain\Repository;
use MeetingPlace\SharedKernel\Domain\OriginIp;

class RepositoryBasedOnMysql extends Repository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllWithGroup(string $group): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, latitude, longitude, added_from_ip, creation_date, description, first_image_url,
                   second_image_url, third_image_url, deleted, groupName  FROM Places 
            WHERE groupName = :groupName
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("groupName", $group, ParameterType::STRING);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfPlaces = [];
        foreach ($results as $result) {
            $arrayOfPlaces[] = new Place(
                $result['id'],
                $result['latitude'],
                $result['longitude'],
                new OriginIp($result['added_from_ip']),
                new \DateTimeImmutable($result['creation_date']),
                $result['description'],
                $result['first_image_url'],
                $result['second_image_url'],
                $result['third_image_url'],
                $result['deleted'],
                $result['groupName']
            );
        }

        return $arrayOfPlaces;
    }

    public function getAll(): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, latitude, longitude, added_from_ip, creation_date, description, first_image_url, second_image_url, third_image_url, deleted, groupName  FROM Places WHERE groupName = :groupName
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("groupName", "", ParameterType::STRING);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfPlaces = [];
        foreach ($results as $result) {
            $arrayOfPlaces[] = new Place(
                $result['id'],
                $result['latitude'],
                $result['longitude'],
                new OriginIp($result['added_from_ip']),
                new \DateTimeImmutable($result['creation_date']),
                $result['description'],
                $result['first_image_url'],
                $result['second_image_url'],
                $result['third_image_url'],
                $result['deleted'],
                $result['groupName']
            );
        }

        return $arrayOfPlaces;
    }

    protected function persist(Place $place): void
    {
        $connection = $this->entityManager->getConnection();

        if ($place->getId() === null) {
            $sql = '
            INSERT INTO Places (latitude, longitude, added_from_ip, creation_date, description, first_image_url, second_image_url, third_image_url, deleted, groupName)
                VALUES (:latitude, :longitude, :added_from_ip, :creation_date, :description, :first_image_url, :second_image_url, :third_image_url, :deleted, :groupName);
            SELECT last_insert_id() AS id;
            ';
        } else {
            $sql = '
            UPDATE Places SET latitude = :latitude, longitude = :longitude, added_from_ip = :added_from_ip,
                              creation_date = :creation_date, description = :description,
                              first_image_url = :first_image_url, second_image_url = :second_image_url,
                              third_image_url = :third_image_ur, deleted = :deleted, groupName = :groupName)
            ';
        }
        $query = $connection->prepare($sql);
        $query->bindValue("latitude", $place->getLatitude(), ParameterType::STRING);
        $query->bindValue("longitude", $place->getLongitude(), ParameterType::STRING);
        $query->bindValue("added_from_ip", $place->getAddedFromIp()->originIp(), ParameterType::INTEGER);
        $query->bindValue("creation_date", $place->getCreationDate()->format(("Y-m-d H:i:s")), ParameterType::STRING);
        $query->bindValue("description", $place->getDescription(), ParameterType::STRING);
        $query->bindValue("first_image_url", $place->getFirstImageUrl(), ParameterType::STRING);
        $query->bindValue("second_image_url", $place->getSecondImageUrl(), ParameterType::STRING);
        $query->bindValue("third_image_url", $place->getThirdImageUrl(), ParameterType::STRING);
        $query->bindValue("deleted", $place->isDeleted(), ParameterType::BOOLEAN);
        $query->bindValue("groupName", $place->getGroup(), ParameterType::STRING);
        $query->executeQuery();

        $sql = 'SELECT last_insert_id() AS id;';
        $query = $connection->prepare($sql);
        $result = $query->executeQuery();
        $place->setId($result->fetchOne());
    }
}