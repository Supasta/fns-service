<?php

namespace FnsService\Service;

use FnsService\Contract\FnsEntityInterface;
use FnsService\Contract\Response;
use FnsService\Factory\Client;

/**
 * Class FnsService
 * Service class for interacting with the FNS API to find INN by passport details.
 */
class FnsService
{
    const API_URL = "https://service.nalog.ru/inn-new-proc.json";

    private Client $client;
    private FnsEntityInterface $fnsEntity;

    /**
     * FnsService constructor.
     */
    public function __construct()
    {
        $this->client = new Client(self::API_URL);
    }

    /**
     * Find the INN (Taxpayer Identification Number) by passport details.
     * @param FnsEntityInterface $fnsEntity The FNS entity containing the passport details
     * @return Response The response object containing the INN information
     */
    public function findInnByPassport(FnsEntityInterface $fnsEntity): Response
    {
        $this->fnsEntity = $fnsEntity;
        return $this->getInnFromFms();
    }

    /**
     * Get the INN from FMS (Federal Migration Service).
     * @return Response The response object containing the INN information
     */
    private function getInnFromFms(): Response
    {
        $response = $this->client->setPostData($this->fnsEntity->toArray())->post();
        if ($response->getRequestId()) {
            return $this->client->setPostData(['c' => 'get', 'requestId' => $response->getRequestId()])->post();
        } else {
            return $response;
        }
    }
}
