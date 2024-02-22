<?php

namespace Supasta\FnsService\Entity;

use Exception;
use Supasta\FnsService\Contract\Response;

/**
 * Class FnsResponse
 * @package Supasta\FnsService\Entity
 */
class FnsResponse extends Response
{
    private $responseObject;

    /**
     * FnsResponse constructor.
     * @param mixed $response The response data to be processed
     * @throws Exception If the response type is not supported or JSON decoding fails
     */
    public function __construct(mixed $response)
    {
        if (is_string($response)) {
            $this->responseObject = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Failed to decode JSON response');
            }
        } elseif (is_array($response) || is_object($response)) {
            $this->responseObject = (object)$response;
        } else {
            throw new Exception('Unsupported response type');
        }
        $this->setData();
    }

    /**
     * Set the response data as an array
     */
    private function setData(): void
    {
        $this->data = (array)$this->responseObject;
    }
}
