# FnsService


## Overview
**EN**:
FnsService is a package designed to simplify the process of finding an Individual's Identification Number (INN) by providing a seamless search functionality. With just the individual's full name, date of birth, and passport series and number, this package streamlines the retrieval of crucial identification information. 

**RU**:
FnsService - пакет, разработанный для упрощения процесса поиска Идентификационного номера налогоплательщика (ИНН) путем предоставления безупречной функциональности поиска. С помощью полного имени человека, даты рождения и серии и номера паспорта этот пакет оптимизирует получение важной идентификационной информации.

## Installation

**EN**:
You can install this package via Composer by running:

**RU**:
Вы можете установить этот пакет через Composer, запустив:

```bash
composer require supasta/fns-service
```

## Usage
```php
<?php
require __DIR__ . '/vendor/autoload.php';

use FnsService\Factory\FNS;

/**
 * If u have simple full name
 */
$fnsResponse = FNS::parse("Иванов Иван", "02.06.1999", "1234 123456")->getInn();
/**
 * If u have full name more than 3 words
 */
$fnsResponse = FNS::direct("Галиев", "Шавкат", "Тимур Угли", "02.06.1999", "FA123456")->getInn();

/**
 * Check errors and handle it
 */
if ($fnsResponse->hasErrors()) {
    var_dump($fnsResponse->getErrors());
} else {
    var_dump($fnsResponse->inn);
}
```

## License

**EN**:
This package is open-sourced software licensed under the <a href="https://opensource.org/license/MIT">MIT license</a>.

**RU**:
Этот пакет представляет собой программное обеспечение с открытым исходным кодом, лицензированное по <a href="https://opensource.org/license/MIT">лицензии MIT</a>.

**Tags:** fns, inn, ИНН, ФНС