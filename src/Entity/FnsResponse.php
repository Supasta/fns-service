<?php

namespace Supasta\FnsService\Entity;

use Supasta\FnsService\Contract\Response;
use Supasta\FnsService\Factory\Localization;

/**
 * Class FnsResponse
 * Represents the response from the FNS service.
 * @package Supasta\FnsService\Entity
 */
class FnsResponse extends Response
{
    /**
     * Get the status code of the response.
     * @return int The status code, default to 200 if not set
     */
    public function getStatus(): int
    {
        return (int)($this->STATUS ?? 200);
    }

    /**
     * Get the error object of the response, if any.
     * @return object|null The error object or null if not set
     */
    public function getError($languages = 'ru'): ?object
    {
        return $this->ERRORS ? (object)$this->prepareErrors($languages) : null;
    }

    private function prepareErrors($languages): array
    {
        if ($languages) {
            return Localization::make()->setLocalization($languages)->localize((array)$this->ERRORS);
        } else {
            return Localization::make()->localize((array)$this->ERRORS);
        }
    }

    /**
     * Get the request ID from the response.
     * @return mixed The request ID
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Get the INN (Taxpayer Identification Number) from the response.
     * @return mixed The INN
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Check if the response has an error.
     * @return object|null The error object or null if no error
     */
    public function hasError()
    {
        return $this->getError();
    }
}
