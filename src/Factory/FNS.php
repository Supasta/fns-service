<?php

namespace Supasta\FnsService\Factory;

use DateTime;
use Supasta\FnsService\Contract\FullName;
use Supasta\FnsService\Contract\Response;
use Supasta\FnsService\Entity\FnsEntity;
use Supasta\FnsService\Entity\ParseFullName;
use Supasta\FnsService\Service\FnsService;

/**
 * Class FNS
 * Factory class for interacting with the FNS service to find INN by passport details.
 */
class FNS
{
    private ?FullName $fullName;
    private ?DateTime $birthDay;
    private ?string $passport;
    private ?FnsEntity $entity;

    /**
     * Create a new instance of FNS with the provided details.
     * @param string $fullName The full name of the individual
     * @param string $birthDate The birthdate of the individual
     * @param string $passport The passport number of the individual
     * @return self
     */
    public static function make(string $fullName, string $birthDate, string $passport): self
    {
        $fns = new self();
        $fns->fullName = new ParseFullName($fullName);
        $fns->birthDay = new DateTime($birthDate);
        $fns->passport = $passport;
        $fns->entity = new FnsEntity($fns->fullName, $fns->birthDay, $fns->passport);
        return $fns;
    }

    /**
     * Get the INN (Taxpayer Identification Number) using the passport details.
     * @return Response The response object containing the INN information
     */
    public function getInn(): Response
    {
        return (new FnsService())->findInnByPassport($this->entity);
    }
}
