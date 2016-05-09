<?php
$autoload = __DIR__ . '/../vendor/autoload.php';

require $autoload;

$ios = new PushNotifications\IOS();

$passphrase = '';
$pemFile = '';
$ios
    ->setEnvironment(1)
    ->setPassphraseDev($passphrase)
    ->setPemDev($pemFile);

$device = '';
$extra = array('a' => 1, 'b' => 2);
$message = "Hola, estos es una prueba! \xF0\x9F\x98\x8D \xE2\x9C\x8C \xF0\x9F\x87\xAA\xF0\x9F\x87\xB8 \xE2\x9A\xA1 \xF0\x9F\x91\xBD";

$ios->setDeviceToken($device);
$ios->setMessage($message);
$ios->setExtraData($extra);
$result = $ios->send();

var_dump($result);
