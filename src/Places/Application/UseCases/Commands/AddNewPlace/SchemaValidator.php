<?php

namespace MeetingPlace\Places\Application\UseCases\Commands\AddNewPlace;

use MeetingPlace\SharedKernel\Application\Exceptions\SchemaError;
use MeetingPlace\SharedKernel\Application\AddNewPlace\Exceptions\ParameterTooLong;
use MeetingPlace\SharedKernel\Application\AddNewPlace\Exceptions\ParameterInvalid;
use function is_string;

class SchemaValidator
{
    /**
     * @throws ParameterInvalid
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    public function validate(array $data): void
    {
        $this->validateLatitude($data);
        $this->validateLongitude($data);
        $this->validateDescription($data);
        $this->validateFirstImageUrl($data);
        $this->validateSecondImageUrl($data);
        $this->validateThirdImageUrl($data);
        $this->validateGroup($data);
    }

    /**
     * @throws ParameterInvalid
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateLatitude(array $data): void
    {
        if (!isset($data['latitude'])) {
            throw SchemaError::createWithError('MISSING.LATITUDE');
        }

        if (is_numeric($data['latitude']) && mb_strlen($data['latitude']) > 24) {
            throw ParameterTooLong::create($data['latitude'], 'latitude');
        }

        if (is_numeric($data['latitude']) && $data['latitude'] === '') {
            throw ParameterInvalid::create($data['latitude'], 'latitude');
        }
    }

    /**
     * @throws ParameterInvalid
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateLongitude(array $data): void
    {
        if (!isset($data['longitude'])) {
            throw SchemaError::createWithError('MISSING.LONGITUDE');
        }

        if (is_numeric($data['longitude']) && mb_strlen($data['longitude']) > 24) {
            throw ParameterTooLong::create($data['longitude'], 'longitude');
        }

        if (is_numeric($data['longitude']) && $data['longitude'] === '') {
            throw ParameterInvalid::create($data['longitude'], 'longitude');
        }
    }

    /**
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateDescription(array $data): void
    {
        if (!isset($data['description'])) {
            throw SchemaError::createWithError('MISSING.DESCRIPTION');
        }

        if (is_string($data['description']) && mb_strlen($data['description']) > 999) {
            throw ParameterTooLong::create($data['description'], 'description');
        }
    }

    /**
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateFirstImageUrl(array $data): void
    {
        if (!isset($data['firstImageUrl'])) {
            throw SchemaError::createWithError('MISSING.FIRST_IMAGE_URL');
        }

        if (is_string($data['firstImageUrl']) && mb_strlen($data['firstImageUrl']) > 199) {
            throw ParameterTooLong::create($data['firstImageUrl'], 'firstImageUrl');
        }
    }

    /**
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateSecondImageUrl(array $data): void
    {
        if (!isset($data['secondImageUrl'])) {
            throw SchemaError::createWithError('MISSING.SECOND_IMAGE_URL');
        }

        if (is_string($data['secondImageUrl']) && mb_strlen($data['secondImageUrl']) > 199) {
            throw ParameterTooLong::create($data['secondImageUrl'], 'secondImageUrl');
        }
    }

    /**
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateThirdImageUrl(array $data): void
    {
        if (!isset($data['thirdImageUrl'])) {
            throw SchemaError::createWithError('MISSING.THIRD_IMAGE_URL');
        }

        if (is_string($data['thirdImageUrl']) && mb_strlen($data['thirdImageUrl']) > 199) {
            throw ParameterTooLong::create($data['thirdImageUrl'], 'thirdImageUrl');
        }
    }

    /**
     * @throws ParameterTooLong
     * @throws SchemaError
     */
    private function validateGroup(array $data): void
    {
        if (!isset($data['group'])) {
            throw SchemaError::createWithError('MISSING.GROUP');
        }

        if (is_string($data['group']) && mb_strlen($data['group']) > 99) {
            throw ParameterTooLong::create($data['group'], 'group');
        }
    }
}
