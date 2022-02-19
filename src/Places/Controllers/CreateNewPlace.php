<?php

namespace MeetingPlace\Places\Controllers;

use JsonException;
use MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace\CommandFactory;
use MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace\Handler;
use MeetingPlace\SharedKernel\Application\Exceptions\SchemaError;
use MeetingPlace\SharedKernel\Controllers\HttpController;
use MeetingPlace\SharedKernel\Domain\Exceptions\ValidationError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateNewPlace extends HttpController
{
    private Handler $handler;
    private CommandFactory $commandFactory;

    public function __construct(Handler $handler, CommandFactory $commandFactory)
    {
        $this->handler = $handler;
        $this->commandFactory = $commandFactory;
    }

    public function run(Request $request): Response
    {
        try {
            $requestData = $this->extractJsonDataFromRequest($request);
            $command = $this->commandFactory->create($requestData);
            $place = $this->handler->handle($command);
        } catch (JsonException $e) {
            return $this->createResponse(400, json_encode(["error" => "invalid_json"]));
        } catch (ValidationError $e) {
            return $this->createResponse(422, json_encode(["error" => $e->getMessage()]));
        } catch (SchemaError $e) {
            return $this->createResponse(400, json_encode(["error" => $e->getMessage()]));
        }
        return $this->createResponse(201, json_encode(["id" => $place->getId()]));
    }
}