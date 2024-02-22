<?php



namespace Supasta\FnsService\Factory;

use Supasta\FnsService\Service\LocalizationService;

class Localization
{

    static public function make()
    {
        return new LocalizationService();
    }
}
