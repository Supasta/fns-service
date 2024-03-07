<?php

declare(strict_types=1);

namespace FnsService\Factory;

use DateTime;
use FnsService\Contracts\FullName;
use FnsService\Entity\DirectFullName;
use FnsService\Entity\FnsEntity;
use FnsService\Entity\FnsResponse;
use FnsService\Entity\ParseFullName;
use FnsService\Services\FnsService;

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
    public static function parse(
        string $fullName,
        string $birthDate,
        string $passport
    ): self {
        $fns = new self();
        $fns->fullName = new ParseFullName($fullName);
        $fns->birthDay = new DateTime($birthDate);
        $fns->passport = $passport;
        $fns->entity = new FnsEntity($fns->fullName, $fns->birthDay, $fns->passport);
        return $fns;
    }

    /**
     * Create a new instance of FNS with the provided direct full name details.
     * @param string $lastName The last name of the individual
     * @param string $firstName The first name of the individual
     * @param string $patronimyc The patronymic name of the individual
     * @param string $birthDate The birthdate of the individual
     * @param string $passport The passport number of the individual
     * @return self
     */
    public static function direct(
        string $lastName,
        string $firstName,
        string $patronymic,
        string $birthDate,
        string $passport
    ): self {
        $fns = new self();
        $fns->fullName = new DirectFullName($lastName, $firstName, $patronymic);
        $fns->birthDay = new DateTime($birthDate);
        $fns->passport = $passport;
        $fns->entity = new FnsEntity($fns->fullName, $fns->birthDay, $fns->passport);
        return $fns;
    }

    /**
     * Get the INN (Taxpayer Identification Number) using the passport details.
     * @return FnsResponse The response object containing the INN information
     */
    public function getInn(): FnsResponse
    {
        return (new FnsService())->findInnByPassport($this->entity);
    }
}
