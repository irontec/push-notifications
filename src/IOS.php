<?php
/**
 * En este archivo se declara la clase "IOS".
 * @link    https://github.com/irontec/push-notifications
 * @author  ddniel16 <dani@irontec.com>
 * @license https://opensource.org/licenses/EUPL-1.1 European Union Public Licence (V. 1.1)
 * @package PushNotifications\IOS
 */
namespace PushNotifications;

/**
 * Esta clase se encarga de gestionar el envio de notificaciones
 * push a dispositivos Apple
 * @version 0.0.1
 * @example examples/ios.php This example is in the "examples" subdirectory
 */
class IOS
{

    /**
     * @var integer Variable de entorno =
     * 0 = Producción
     * 1 = Desarrollo
     */
    protected $_environment = 1;

    /**
     * @var string Rutal al certificado .pem de producción
     */
    protected $_pem;

    /**
     * @var string Rutal al certificado .pem de desarrollo
     */
    protected $_pemDev;

    /**
     * @var string Contraseña del certificado en producción
     */
    protected $_passphrase;

    /**
     * @var string Contraseña del certificado en desarrollo
     */
    protected $_passphraseDev;

    /**
     * @var integer Write interval in micro seconds.
     */
    protected $_writeInterval = 1;

    /**
     * @var integer Send retry times.
     */
    protected $_sendRetryTimes = 1;

    /**
     * @var integer Connection timeout in seconds.
     */
    protected $_connectTimeout = 1;

    /**
     * @var integer This message will expire in N seconds if not successful
     * delivered.
     */
    protected $_expiry = 60;

    /**
     * @var string Identificador del dispositivo
     */
    protected $_deviceToken;

    /**
     * @var string Mensaje de la notificación
     */
    protected $_message;

    /**
     * @var array Información extra que se envia al dispositivo
     */
    protected $_extraData;

    /**
     * Obtiene el modo de ejecución (Desarrollo o Producción)
     * @return int
     */
    public function getEnvironment()
    {
        return (int) $this->_environment;
    }

    /**
     * Declara el modo de ejecución (Desarrollo o Producción)
     * @param int $environment
     * @return \PushNotifications\IOS
     */
    public function setEnvironment($environment)
    {
        $this->_environment = $environment;
        return $this;
    }

    /**
     * Obtiene el archivo ".pem" de producción
     * @return string
     */
    public function getPem()
    {
        return $this->_pem;
    }

    /**
     * Declara el archivo ".pem" de producción
     * @param string $pem
     * @return \PushNotifications\IOS
     */
    public function setPem($pem)
    {
        $this->_pem = $pem;
        return $this;
    }

    /**
     * Obtiene el archivo ".pem" de desarrollo
     * @return string
     */
    public function getPemDev()
    {
        return $this->_pemDev;
    }

    /**
     * Declara el archivo ".pem" de desarrollo
     * @param string $pemDev
     * @return \PushNotifications\IOS
     */
    public function setPemDev($pemDev)
    {
        $this->_pemDev = $pemDev;
        return $this;
    }

    /**
     * Obtiene la contraseña "passphrase" de producción
     * @return string
     */
    public function getPassphrase()
    {
        return $this->_passphrase;
    }

    /**
     * Declara la contraseña "passphrase" de producción
     * @param string $passphrase
     * @return \PushNotifications\IOS
     */
    public function setPassphrase($passphrase)
    {
        $this->_passphrase = $passphrase;
        return $this;
    }

    /**
     * Obtiene la contraseña "passphrase" de desarrollo
     * @return string
     */
    public function getPassphraseDev()
    {
        return $this->_passphraseDev;
    }

    /**
     * Declara la contraseña "passphrase" de desarrollo
     * @param string $passphraseDev
     * @return \PushNotifications\IOS
     */
    public function setPassphraseDev($passphraseDev)
    {
        $this->_passphraseDev = $passphraseDev;
        return $this;
    }

    public function getWriteInterval()
    {
        return $this->_writeInterval;
    }

    public function setWriteInterval($writeInterval)
    {
        $this->_writeInterval = $writeInterval;
        return $this;
    }

    public function getSendRetryTimes()
    {
        return $this->_sendRetryTimes;
    }

    public function setSendRetryTimes($sendRetryTimes)
    {
        $this->_sendRetryTimes = $sendRetryTimes;
        return $this;
    }

    public function getConnectTimeout()
    {
        return $this->_connectTimeout;
    }

    public function setConnectTimeout($connectTimeout)
    {
        $this->_connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * Obtiene el UUID del dispositivo al que se le va a enviar la notificación
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->_deviceToken;
    }

    /**
     * Declara el UUID del dispositivo al que se le va a enviar la notificación
     * @param string $deviceToken
     * @return \PushNotifications\IOS
     */
    public function setDeviceToken($deviceToken)
    {
        $this->_deviceToken = $deviceToken;
        return $this;
    }

    /**
     * Obtiene el mensaje PUSH que se visualizara en la notificación.
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Declara el mensaje PUSH que se visualizara en la notificación.
     * @param string $message
     * @return \PushNotifications\IOS
     */
    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    public function getExpiry()
    {
        return $this->_expiry;
    }

    public function setExpiry($expiry)
    {
        $this->_expiry = $expiry;
        return $this;
    }

    /**
     * Obtiene las opciones custom en las notificiones
     * @return array
     */
    public function getExtraData()
    {
        return $this->_extraData;
    }

    /**
     * Declara las opciones custom en las notificiones
     * @param array $extraData
     * @return \PushNotifications\IOS
     */
    public function setExtraData(array $extraData)
    {
        $this->_extraData = $extraData;
        return $this;
    }

    /**
     * Gestiona el envio de las notificaciones con la libreria "ApnsPHP"
     */
    public function send()
    {

        if ($this->getEnvironment() === 1) {

            $push = new \ApnsPHP_Push(
                $this->getEnvironment(),
                $this->getPemDev()
            );
            $push->setProviderCertificatePassphrase(
                $this->getPassphraseDev()
            );

        } else {

            $push = new \ApnsPHP_Push(
                $this->getEnvironment(),
                $this->getPem()
            );
            $push->setProviderCertificatePassphrase(
                $this->getPassphrase()
            );

        }

        $push->setWriteInterval($this->getWriteInterval());
        $push->setSendRetryTimes($this->getSendRetryTimes());
        $push->setConnectTimeout($this->getConnectTimeout());
        $push->connect();

        try {

            $message = new \ApnsPHP_Message($this->getDeviceToken());
            $message->setText($this->getMessage());
            $message->setSound();

            if (!empty($this->getExtraData())) {
                foreach ($this->getExtraData() as $key => $value) {
                    $message->setCustomProperty($key, $value);
                }
            }

            $message->setExpiry($this->getExpiry());
            $push->add($message);

            $push->send();
            $push->disconnect();

            $aErrorQueue = $push->getErrors();

        } catch(\Exception $e) {
            $aErrorQueue = array($e->getMessage());
        }

        if (!empty($aErrorQueue)) {
            return $aErrorQueue;
        }

        return true;

    }

}