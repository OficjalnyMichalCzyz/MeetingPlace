<?php

namespace MeetingPlace\Ratings\Controllers;

use MeetingPlace\Ratings\Domain\Rating;
use Symfony\Component\HttpFoundation\Request;
use MeetingPlace\Ratings\Application\UseCases\Queries\GetRatings\Handler;
use MeetingPlace\Ratings\Application\UseCases\Queries\GetRatings\Query;
use MeetingPlace\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetRatings extends HttpController
{
    private Handler $handler;

    /**
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function run(Request $request): Response
    {
        $queryParameters = $request->query->all();

        if (!isset($queryParameters['id'], $queryParameters['place'])) {
            $this->createResponse(400, json_encode(["error" => "invalid_query_parameters"]));
        }

        if ($queryParameters['id'] === '' || mb_strlen($queryParameters['id']) > 11) {
            $this->createResponse(400, json_encode(["error" => "invalid_query_parameters"]));
        }

        $query = new Query($queryParameters['id'], $queryParameters['place'] === 'true');
        $arrayOfRatings = $this->handler->handle($query);
        $finalResponse = [];
        /** @var Rating $rating */
        foreach ($arrayOfRatings as $rating) {
            $finalResponse[] = [
                "id" => $rating->getId(),
                "creationTime" => $rating->getCreationTime()->format('Y-m-d H:i:s'),
                "description" => $rating->getDescription(),
                "type" => $rating->getType()->getName(),
                "placeId" => $rating->getPlaceId(),
                "ratingId" => $rating->getRatingId(),
                "isComment" => $rating->isComment()
            ];
        }

        return $this->createResponse(200, json_encode($finalResponse));
    }
}