<?php

namespace MeetingPlace\Ratings\Application\UseCases\Commands\RateSomething;

use MeetingPlace\SharedKernel\Application\Exceptions\SchemaError;
use MeetingPlace\SharedKernel\Application\AddNewPlace\Exceptions\ParameterTooLong;
use MeetingPlace\SharedKernel\Application\AddNewPlace\Exceptions\ParameterInvalid;
use function is_int;
use function is_bool;
use function is_string;

class SchemaValidator
{
    /**
     * @throws SchemaError
     * @throws ParameterTooLong
     * @throws ParameterInvalid
     */
    public function validate(array $data): void
    {
        $this->validateIsComment($data);
        $this->validateBody($data);
        $this->validateType($data);
        $this->validatePlaceId($data);
        $this->validateRatingId($data);
    }

    /**
     * @throws SchemaError
     */
    private function validateIsComment(array $data): void
    {
        if (!isset($data['isComment'])) {
            throw SchemaError::createWithError('MISSING.IS_COMMENT');
        }

        if (!is_bool($data['isComment'])) {
            throw SchemaError::createWithError('INVALID_TYPE.IS_COMMENT');
        }
    }

    /**
     * @throws SchemaError
     * @throws ParameterTooLong
     */
    private function validateBody(array $data): void
    {
        if (!isset($data['body']) && ($data['body']) !== null) {
            throw SchemaError::createWithError('MISSING.BODY');
        }

        if (!is_string($data['body']) && ($data['body']) !== null) {
            throw SchemaError::createWithError('INVALID_TYPE.BODY');
        }

        if (($data['body']) === null && $data['isComment'] === true) {
            throw SchemaError::createWithError('INVALID_FORM.BODY');
        }

        if (($data['body']) !== null && $data['isComment'] === false) {
            throw SchemaError::createWithError('INVALID_FORM.BODY');
        }

        if (is_string($data['body']) && mb_strlen($data['body']) > 499) {
            throw ParameterTooLong::create($data['body'], 'body');
        }
    }

    /**
     * @throws SchemaError
     * @throws ParameterInvalid
     */
    private function validateType(array $data): void
    {
        if (!isset($data['type'])) {
            throw SchemaError::createWithError('MISSING.TYPE');
        }

        if (!is_int($data['type'])) {
            throw SchemaError::createWithError('INVALID_TYPE.TYPE');
        }

        if (is_int($data['type']) && $data['type'] !== 0 && $data['type'] !== 1) {
            throw ParameterInvalid::create($data['type'], 'type');
        }
    }

    /**
     * @throws SchemaError
     * @throws ParameterTooLong
     */
    private function validatePlaceId(array $data): void
    {
        if (!isset($data['placeId']) && ($data['placeId']) !== null) {
            throw SchemaError::createWithError('MISSING.PLACE_ID');
        }

        if (!is_int($data['placeId']) && ($data['placeId']) !== null) {
            throw SchemaError::createWithError('INVALID_TYPE.PLACE_ID');
        }

        if (is_int($data['placeId']) && mb_strlen((string)$data['placeId']) > 11) {
            throw ParameterTooLong::create($data['placeId'], 'placeId');
        }
    }

    /**
     * @throws SchemaError
     * @throws ParameterTooLong
     */
    private function validateRatingId(array $data): void
    {
        if (!isset($data['ratingId']) && ($data['ratingId']) !== null) {
            throw SchemaError::createWithError('MISSING.RATING_ID');
        }

        if (!is_int($data['ratingId']) && ($data['ratingId']) !== null) {
            throw SchemaError::createWithError('INVALID_TYPE.RATING_ID');
        }

        if (is_int($data['ratingId']) && mb_strlen((string)$data['ratingId']) > 11) {
            throw ParameterTooLong::create($data['ratingId'], 'ratingId');
        }
    }
}