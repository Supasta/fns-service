<?php
require __DIR__ . '/vendor/autoload.php';

use Supasta\FnsService\Factory\FNS;

$fnsResponse = FNS::make("Чертова Юлия Алексеевна", "03.01.2004", "6017 270691")->getInn();
if ($fnsResponse->hasError()) {
    var_dump($fnsResponse->getError());
} else {
    var_dump($fnsResponse->inn);
}
