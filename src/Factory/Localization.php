<?php

namespace FnsService\Factory;

use FnsService\Service\LocalizationService;

/**
 * Class Localization
 * Factory class for creating LocalizationService instances.
 */
class Localization
{
    /**
     * Create a new instance of LocalizationService.
     *
     * @return LocalizationService A new instance of LocalizationService.
     */
    static public function make()
    {
        return new LocalizationService();
    }
}
