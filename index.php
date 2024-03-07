<?php
require __DIR__ . '/vendor/autoload.php';

use FnsService\Factory\FNS;

/**
 * Если ФИО целиком
 */
$fnsResponse = FNS::parse("Иванов Иван", "02.06.1999", "1234 123456")->getInn();
/**
 * Если ФИО сложное
 */
$fnsResponse = FNS::direct("Галиев", "Шавкат", "Тимур Угли", "02.06.1999", "FA123456")->getInn();

if ($fnsResponse->hasErrors()) {
    var_dump($fnsResponse->getErrors());
} else {
    var_dump($fnsResponse->inn);
}
