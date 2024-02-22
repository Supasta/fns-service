<?php

namespace Supasta\FnsService\Factory;

use Exception;
use Supasta\FnsService\Contract\Response;
use Supasta\FnsService\Entity\FnsResponse;

/**
 * Class Client
 * Handles HTTP requests using cURL and returns FnsResponse objects.
 */
class Client
{
    private string $url;
    private ?array $postData = null;
    private int $timeout = 120;

    /**
     * Client constructor.
     * @param string $url The URL to make requests to
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Set the POST data for the request.
     * @param array|null $postData The data to be sent in the POST request
     * @return $this
     */
    public function setPostData(?array $postData): self
    {
        $this->postData = $postData;
        return $this;
    }

    /**
     * Set the timeout for the request.
     * @param int $timeout The timeout value in seconds
     * @return $this
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Send a GET request and return the response as an FnsResponse object.
     * @return Response The response object
     * @throws Exception If there is a cURL error
     */
    public function get(): Response
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('Curl error: ' . $error);
        }
        curl_close($ch);
        return new FnsResponse($response);
    }

    /**
     * Send a POST request and return the response as an FnsResponse object.
     * @return Response The response object
     * @throws Exception If there is a cURL error
     */
    public function post(): Response
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('Curl error: ' . $error);
        }
        curl_close($ch);
        return new FnsResponse($response);
    }
}
