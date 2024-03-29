<?php

declare(strict_types=1);

namespace FnsService\Entity;

use FnsService\Contracts\Response;
use FnsService\Factory\Localization;

/**
 * Class FnsResponse
 * Represents the response from the FNS service.
 * @package FnsService\Entity
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
     * @param string $languages The language for error localization
     * @return object|null The error object or null if not set
     */
    public function getErrors($languages = 'ru'): ?object
    {
        return $this->ERRORS ? (object)$this->prepareErrors($languages) : null;
    }

    /**
     * Prepare errors for localization based on language.
     * @param string $languages The language for error localization
     * @return array The prepared errors array
     */
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
     * @return string|null The request ID
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Get the INN (Taxpayer Identification Number) from the response.
     * @return string|null The INN
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * Check if the response has an error.
     * @return object|null The error object or null if no error
     */
    public function hasErrors(): ?object
    {
        return $this->getErrors();
    }
}
