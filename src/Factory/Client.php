<?php

namespace Supasta\FnsService\Factory;

use Exception;
use FnsErrorResponse;
use Supasta\FnsService\Contract\FnsResponse;
use Supasta\FnsService\Entity\FnsErrorResponse as EntityFnsErrorResponse;

class Client
{
    private string $url;
    private ?array $postData = null;
    private int $timeout = 120; // Default timeout of 10 seconds

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function setPostData(?array $postData): self
    {
        $this->postData = $postData;
        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function get(): FnsResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout); // Set the timeout
        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('Curl error: ' . $error);
        }
        curl_close($ch);
        return new EntityFnsErrorResponse($response);
    }

    #[Client]
    public function post(): FnsResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout); // Set the timeout
        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('Curl error: ' . $error);
        }
        curl_close($ch);
        return new EntityFnsErrorResponse($response);
    }
}
