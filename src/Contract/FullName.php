<?php

namespace FnsService\Contract;

abstract class FullName
{
    /**
     * @var string The last name of the person.
     */
    public $lastName;

    /**
     * @var string The first name of the person.
     */
    public $firstName;

    /**
     * @var string|null The patronymic (middle name) of the person.
     */
    public $patronymic;
}
