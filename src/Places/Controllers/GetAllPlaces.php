<?php

namespace MeetingPlace\Places\Controllers;

use MeetingPlace\Places\Application\UseCases\Queries\GetAllPlaces\Query;
use MeetingPlace\Places\Application\UseCases\Queries\GetAllPlaces\Handler;
use MeetingPlace\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetAllPlaces extends HttpController
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function run(?string $groupName): Response
    {
        $query = null;
        if ($groupName !== null) {
            if (mb_strlen($groupName) > 99) {
                $this->createResponse(400, json_encode(["error" => "invalid_query_parameters"]));
            }
            $query = new Query($groupName);
        }

        $arrayOfPlaces = $this->handler->handle($query);
        $finalResponse = [];
        foreach ($arrayOfPlaces as $place) {
            $finalResponse[] = [
                'id' => $place->getId(),
                'latitude' => $place->getLatitude(),
                'longitude' => $place->getLongitude(),
                'creationDate' => $place->getCreationDate()->format('Y-m-d H:i:s'),
                'description' => $place->getDescription(),
                'firstImageUrl' => $place->getFirstImageUrl(),
                'secondImageUrl' => $place->getSecondImageUrl(),
                'thirdImageUrl' => $place->getThirdImageUrl(),
                'group' => $place->getGroup()
            ];
        }
        return $this->createResponse(200, json_encode($finalResponse));
    }
}