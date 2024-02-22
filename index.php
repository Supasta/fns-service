<?php

use Supasta\FnsService\Entity\DirectFullName;
use Supasta\FnsService\Entity\FnsEntity;
use Supasta\FnsService\Entity\ParseFullName;
use Supasta\FnsService\Factory\Client;
use Supasta\FnsService\Service\FnsService;

require __DIR__ . '/vendor/autoload.php';

// $fullName = new ParseFullName("Буртикd Валерий Владимирович");

// $entity = new FnsEntity($fullName, new DateTime('06.02.1991'), identifyDocument: "2510 503246");

// $fnsService = (new FnsService())->findInnByPassport($entity);


// var_dump($fnsService);
$client = new Client('https://service.nalog.ru/inn-new-proc.json?fam=%D0%91%D1%83%D1%80%D1%82%D0%B8%D0%BA%D0%BE%D0%B2&nam=%D0%92%D0%B0%D0%BB%D0%B5%D1%80%D0%B8%D0%B9&otch=%D0%92%D0%BB%D0%B0%D0%B4%D0%B8%D0%BC%D0%B8%D1%80%D0%BE%D0%B2%D0%B8%D1%87&docno=2510+503246&c=find&captcha=&captchaToken=&bdate=06.02.1991&doctype=10');
$response = $client->post();

var_dump($response);

// // Initialize 
// $ch = curl_init();

// // Set the URL to fetch
// curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts/1');

// // Set the return transfer to true so that the response is returned as a string
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // Execute the request
// $response = curl_exec($ch);

// // Close cURL session
// curl_close($ch);

// // Output the response
// echo $response;