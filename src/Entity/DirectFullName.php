<?php

namespace FnsService\Entity;

use FnsService\Contract\FullName;

class DirectFullName extends FullName
{
    /**
     * FullName constructor.
     *
     * @param string $lastName The last name of the person.
     * @param string $firstName The first name of the person.
     * @param string $patronymic The patronymic of the person.
     */
    public function __construct(?string $lastName, ?string $firstName, ?string $patronymic)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->patronymic = $patronymic;
    }
}
