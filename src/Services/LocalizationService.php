<?php

declare(strict_types=1);

namespace FnsService\Services;

use Exception;
use InvalidArgumentException;
use FnsService\Contracts\Localization;

/**
 * Class LocalizationService
 * Implementation of the Localization interface for language localization.
 */
class LocalizationService implements Localization
{
    private $language = 'ru';
    private $languages = ['ru', 'en'];

    /**
     * Set the localization language.
     *
     * @param string $language The language code to set.
     * @return LocalizationService The LocalizationService instance.
     * @throws InvalidArgumentException If the language is not supported.
     */
    public function setLocalization(string $language): self
    {
        if (!in_array($language, $this->languages)) {
            throw new InvalidArgumentException(sprintf(
                'Error transformer for "%s" language is not implemented.',
                $language
            ));
        }

        $this->language = $language;
        return $this;
    }

    /**
     * Localize an array of values using the language dictionary.
     *
     * @param array $array The array of values to localize.
     * @return array The localized array of values.
     */
    public function localize(array $array): array
    {
        $dictionary = $this->getFile();
        $temp = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $temp[] = sprintf(
                        "%s : %s",
                        $dictionary[$key] ?? $key,
                        isset($dictionary[$item]) ? $dictionary[$item] : $item
                    );
                }
            }
        }

        return $temp;
    }

    /**
     * Get the language dictionary from the language file.
     *
     * @return array The language dictionary array.
     * @throws Exception If the language file is not found or there is an error reading or decoding it.
     */
    public function getFile(): array
    {
        $filePath = __DIR__ . "/lang/{$this->language}.json";

        if (!file_exists($filePath)) {
            throw new Exception(sprintf('Language file %s.json not found', $this->language));
        }

        $json = file_get_contents($filePath);

        if ($json === false) {
            throw new Exception(sprintf('Error reading %s.json language file', $this->language));
        }

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error decoding JSON file');
        }

        return $data;
    }
}
