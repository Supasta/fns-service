<?php

namespace Supasta\FnsService\Entity;

use Supasta\FnsService\Contract\FullName;

class ParseFullName extends FullName
{
    /**
     * FullName constructor.
     *
     * @param string $fullName The full name of the person.
     */
    public function __construct(string $fullName)
    {
        $fullNameArray = explode(' ', $fullName);
        $this->lastName = $fullNameArray[0];
        $this->firstName = $fullNameArray[1];
        $this->patronymic = $this->extractPatronymic($fullNameArray);
    }

    /**
     * Extract the patronymic part from the full name array.
     *
     * @param array $fullNameArray The array of full name parts.
     * @return string|null The patronymic part or null if not present.
     */
    private function extractPatronymic(array $fullNameArray): ?string
    {
        $patronymicParts = array_slice($fullNameArray, 2);
        if (!empty($patronymicParts)) {
            return implode(' ', $patronymicParts);
        }
        return null;
    }
}
