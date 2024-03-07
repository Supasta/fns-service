<?php

declare(strict_types=1);

namespace FnsService\Factory;

use FnsService\Contracts\Localization as ContractsLocalization;
use FnsService\Services\LocalizationService;

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
    static public function make(): ContractsLocalization
    {
        return new LocalizationService();
    }
}
