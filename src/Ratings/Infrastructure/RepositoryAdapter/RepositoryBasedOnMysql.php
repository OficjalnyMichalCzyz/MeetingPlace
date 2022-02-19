<?php

namespace MeetingPlace\Ratings\Infrastructure\RepositoryAdapter;

use Doctrine\DBAL\ParameterType;
use MeetingPlace\Ratings\Domain\Rating;
use Doctrine\ORM\EntityManagerInterface;
use MeetingPlace\Ratings\Domain\Type;
use MeetingPlace\Ratings\Domain\Repository;
use MeetingPlace\SharedKernel\Domain\OriginIp;
use MeetingPlace\Ratings\Domain\Exceptions\AlreadyRated;

class RepositoryBasedOnMysql extends Repository
{
    private EntityManagerInterface $entityManager;

    /**
     * RepositoryBasedOnMysql constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function getAllByPlaceId(int $identifier): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, added_from_ip, creation_date, description, deleted, `type`,place_id ,rating_id ,is_comment FROM Ratings 
            WHERE place_id = :place_id
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("place_id", $identifier, ParameterType::INTEGER);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfRatings = [];
        foreach ($results as $result) {
            $arrayOfRatings[] = new Rating(
                $result["id"],
                new OriginIp($result["added_from_ip"]),
                new \DateTimeImmutable($result["creation_date"]),
                $result["description"],
                $result["deleted"],
                new Type($result["type"]),
                $result["place_id"],
                $result["rating_id"],
                $result["is_comment"]
            );
        }
        return $arrayOfRatings;
    }

    /**
     * @inheritDoc
     */
    public function getAllByRatingId(int $identifier): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, added_from_ip, creation_date, description, deleted, `type`,place_id ,rating_id ,is_comment FROM Ratings 
            WHERE rating_id = :rating_id
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("rating_id", $identifier, ParameterType::INTEGER);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfRatings = [];
        foreach ($results as $result) {
            $arrayOfRatings[] = new Rating(
                $result["id"],
                new OriginIp($result["added_from_ip"]),
                new \DateTimeImmutable($result["creation_date"]),
                $result["description"],
                $result["deleted"],
                new Type($result["type"]),
                $result["place_id"],
                $result["rating_id"],
                $result["is_comment"]
            );
        }
        return $arrayOfRatings;
    }

    /**
     * @throws AlreadyRated
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function add(Rating $rating): void
    {
        $connection = $this->entityManager->getConnection();
        //if ($rating->getPlaceId() !== null) {
        //    $sql = 'SELECT added_from_ip FROM Ratings
        //    WHERE place_id = :place_id';
        //    $query = $connection->prepare($sql);
        //    $query->bindValue('place_id', $rating->getPlaceId(), ParameterType::INTEGER);
        //    if($rating->getAddedFromIp()->originIp() == $query->executeQuery()->fetchOne()) {
        //        throw AlreadyRated::create($rating->getAddedFromIp()->originIp());
        //    }
        //}
        //
        //if ($rating->getRatingId() !== null) {
        //    $sql = 'SELECT added_from_ip FROM Ratings
        //    WHERE rating_id = :rating_id';
        //    $query = $connection->prepare($sql);
        //    $query->bindValue('rating_id', $rating->getRatingId(), ParameterType::INTEGER);
        //    if($rating->getAddedFromIp()->originIp() == $query->executeQuery()->fetchOne()) {
        //        throw AlreadyRated::create($rating->getAddedFromIp()->originIp());
        //    }
        //}

        $sql = '
            INSERT INTO Ratings (added_from_ip, creation_date, description, deleted, `type`, place_id, rating_id, is_comment)
                VALUES (:added_from_ip, :creation_date, :description, :deleted, :ratingType, :place_id, :rating_id,:is_comment);
            SELECT last_insert_id() AS id;
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("added_from_ip", $rating->getAddedFromIp()->originIp(), ParameterType::STRING);
        $query->bindValue("creation_date", $rating->getCreationTime()->format(('Y-m-d H:i:s')), ParameterType::STRING);
        $query->bindValue("description", $rating->getDescription(), ParameterType::STRING);
        $query->bindValue("deleted", $rating->isDeleted(), ParameterType::BOOLEAN);
        $query->bindValue("ratingType", $rating->getType()->getValue(), ParameterType::INTEGER);
        $query->bindValue("place_id", $rating->getPlaceId(), ParameterType::INTEGER);
        $query->bindValue("rating_id", $rating->getRatingId(), ParameterType::INTEGER);
        $query->bindValue("is_comment", $rating->isComment(), ParameterType::BOOLEAN);
        $query->executeQuery();

        $sql = 'SELECT last_insert_id() AS id;';
        $query = $connection->prepare($sql);
        $result = $query->executeQuery();
        $rating->setId($result->fetchOne());
    }
}