PushNotifications
=================

Libreria para gestionar facilmente las notificaciónes push con Android e IOS.

Instalación
===========

### Instalación con Composer

````sh
composer require irontec/pushnotifications
````

or
````json
    {
        "require": {
            "require irontec/pushnotifications": ">=1.0"
        }
    }
````

# Ejemplos

## Android

Envio de una notificación a un dispositivo Android

````php
<?php

$android = new PushNotifications\Android();

$android->setApikey('******');
$android->setDeviceToken('');
$android->setMessage('');
$android->setExtraData(array('a' => 1, 'b' => 2));

$android->send();

````

## IOS

Envio de una notificación a un dispositivo IOS

````php
<?php

$ios = new PushNotifications\IOS();

$ios->setEnvironment(1);
$ios->setPassphraseDev('******');
$ios->setPemDev('/certs/dev/app.pem');

$ios->setWriteInterval(1);
$ios->setSendRetryTimes(1);
$ios->setConnectTimeout(1);
$ios->setExpiry(60);

$ios->setDeviceToken('');
$ios->setMessage('');
$ios->setExtraData(array('a' => 1, 'b' => 2));
$ios->send();

````