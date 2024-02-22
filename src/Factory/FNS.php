<?php

namespace Supasta\FnsService\Factory;

use DateTime;
use Supasta\FnsService\Contract\FullName;
use Supasta\FnsService\Entity\FnsEntity;
use Supasta\FnsService\Entity\ParseFullName;
use Supasta\FnsService\Service\FnsService;

class FNS
{

    private ?FullName $fullName;
    private ?DateTime $birthDay;
    private ?string $passport;
    private ?FnsEntity $entity;

    static function make(string $fullName, string $birthDate, string $passport): self
    {
        $fns = new self();
        $fns->fullName = new ParseFullName($fullName);
        $fns->birthDay = new DateTime($birthDate);
        $fns->passport = $passport;
        return $fns;
    }

    public function setFullName()
    {
        return $this;
    }
    public function setBirthDay()
    {
    }
    public function setPassport()
    {
    }
    public function getInn(): array
    {
        return (new FnsService())->findInnByPassport($this->entity);
    }
}
