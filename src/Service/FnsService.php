<?php

namespace Supasta\FnsService\Service;

use Exception;
use Supasta\FnsService\Contract\FnsEntityInterface;
use Supasta\FnsService\Contract\FnsResponse;
use Supasta\FnsService\Factory\Client;

class FnsService
{
    const TIMEOUT = 10;
    /**
     * API URL for FNS service.
     */
    const API_URL = "https://service.nalog.ru/inn-new-proc.json";

    private string $content = '';
    private Client $client;

    /**
     * @var FnsEntity|null The FNS entity to search for.
     */
    private $fnsEntity;


    public function __construct()
    {
        $this->client = new Client(self::API_URL);
    }

    /**
     * Find the INN (Taxpayer Identification Number) by Passport using FNS service.
     *
     * @param FnsEntity $fnsEntity The FNS entity with passport details.
     * @return array|null The found INN or null if not found.
     * @throws Exception If an error occurs during the request.
     */
    public function findInnByPassport(FnsEntityInterface $fnsEntity): ?object
    {
        $this->fnsEntity = $fnsEntity;
        return $this->getInnFromFms();
    }


    /**
     * Send a POST request to the FNS service to find the INN.
     *
     * @return string|null The found INN or null if not found.
     * @throws Exception If an error occurs during the request.
     */
    private function getInnFromFms(): FnsResponse
    {
        $response = $this->client->setPostData($this->fnsEntity->toArray())->post();
        if ($response->getRequestId()) {
            return $this->client->setPostData(['c' => 'get', 'requestId' => $response->getRequestId()])->post();
        } else return [];
    }

}
