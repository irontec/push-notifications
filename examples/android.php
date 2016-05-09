<?php
$autoload = __DIR__ . '/../vendor/autoload.php';

require $autoload;

$android = new PushNotifications\Android();

$apiKey = '';
$device = '';
$extra = array('a' => 1, 'b' => 2);
$message = "Hola, estos es una prueba! \xF0\x9F\x98\x8D \xE2\x9C\x8C \xF0\x9F\x87\xAA\xF0\x9F\x87\xB8 \xE2\x9A\xA1 \xF0\x9F\x91\xBD";


$android
    ->devModel(true)
    ->setApikeyDev($apiKey);

$android
    ->setDeviceToken($device)
    ->setMessage($message)
    ->setExtraData($extra)
    ->send();

if ($android->getSuccess()) {
    var_dump($android->getBody());
    var_dump($android->getHeaders());
    var_dump($android->getStatusCode());
    die('Ok');
} else {
    var_dump($android->getBody());
    die('Error');
}