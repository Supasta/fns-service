<?php

namespace Supasta\FnsService\Entity;

use Exception;
use Supasta\FnsService\Contract\FnsResponse;

class FnsErrorResponse extends FnsResponse
{
    private $responseObject;

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

    private function setData()
    {
        $this->data = (array)$this->responseObject;
    }
}
