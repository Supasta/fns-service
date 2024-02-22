<?php

namespace Supasta\FnsService\Contract;

use Exception;

/**
 * Abstract class Response
 * Represents the response received from FNS service.
 */
abstract class Response
{
    protected $data = [];

    /**
     * Check if the key exists in the response data.
     * @param string $key The key to check
     * @return bool True if the key exists, false otherwise
     */
    protected function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Check if the response data is empty.
     * @return bool True if the response data is empty, false otherwise
     */
    protected function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * Magic method to retrieve data from the response.
     * @param string $key The key to retrieve data for
     * @return mixed|null The data for the key or null if key does not exist
     */
    public function __get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * Magic method to set data in the response.
     * @param string $key The key to set data for
     * @param mixed $value The value to set
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Response constructor.
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
     * Set the response data as an array.
     */
    private function setData(): void
    {
        $this->data = (array)$this->responseObject;
    }
}
