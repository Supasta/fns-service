<?php

namespace Supasta\FnsService\Service;

use Exception;
use InvalidArgumentException;
use Supasta\FnsService\Contract\Localization;

class LocalizationService implements Localization
{
    private $language = 'en';
    private $languages = [
        'ru',
        'en'
    ];

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

    public function localize(array $array): array
    {
        $dictionary = $this->getFile();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $temp[] = sprintf("%s : %s", $dictionary[$key] ?? $key, isset($dictionary[$item]) ? $dictionary[$item] : $item);
                }
            }
        }
        return $temp;
    }

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
