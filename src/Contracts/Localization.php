<?php
declare(strict_types=1);

namespace FnsService\Contracts;

/**
 * Interface Localization
 * Defines methods for localizing arrays based on a specific language.
 * @package FnsService\Contracts
 */
interface Localization
{
    /**
     * Set the localization language for the localization process.
     * @param string $language The language code to set
     * @return self The instance of the Localization interface
     */
    public function setLocalization(string $language): self;

    /**
     * Localize an array based on the set language.
     * @param array $array The array to be localized
     * @return array The localized array
     */
    public function localize(array $array): array;
}