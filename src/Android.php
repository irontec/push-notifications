<?php
/**
 * En este archivo se declara la clase "Android".
 * @link    https://github.com/irontec/push-notifications
 * @author  ddniel16 <dani@irontec.com>
 * @license https://opensource.org/licenses/EUPL-1.1 European Union Public Licence (V. 1.1)
 * @package PushNotifications\Android
 */
namespace PushNotifications;

/**
 * Esta clase se encarga de gestionar el envio de notificaciones
 * push a dispositivos Android
 * @version 0.0.1
 * @example examples/android.php This example is in the "examples" subdirectory
 */
class Android
{

    /**
     * Para obtener el Token de desarrollo (getApikeyDev)
     * o el Token producción (getApikey)
     * @var boolen
     */
    protected $_devMode = false;

    /**
     * URL del servicio de notificaciones push de android
     * @var string
     */
    protected $_androidURL = 'https://android.googleapis.com/gcm/send';

    /**
     * Token para las notificaciones de la aplicación
     * @var string
     */
    protected $_apikey = NULL;

    /**
     * Token para las notificaciones de la aplicación (Desarrollo)
     * @var string
     */
    protected $_apikeyDev = NULL;

    /**
     * Identificador de dispositivo
     * @var string
     */
    protected $_deviceToken = NULL;

    /**
     * Mensaje de la notificación
     * @var string
     */
    protected $_message = NULL;

    /**
     * Información extra que se envia al dispositivo
     * @var array
     */
    protected $_extraData = array();

    /**
     * Json Decode de la respuesta
     * @var object
     */
    protected $_body;

    /**
     * Headers de respuesta
     * @var array
     */
    protected $_headers;

    /**
     * Status Code de la respuesta
     * @var int
     */
    protected $_statusCode;

    /**
     * Estado de la respuesta
     * @var boolean
     */
    protected $_success;

    /**
     * Obtiene el modo de ejecución del envío
     * @return \PushNotifications\boolen
     */
    public function isDevMode()
    {
        return $this->_devMode;
    }

    /**
     * Declara el modo de ejecución de los envios
     * @param boolean $devMode
     * @return \PushNotifications\Android
     */
    public function devModel($devMode)
    {
        $this->_devMode = (bool) $devMode;
        return $this;
    }

    /**
     * Obtiene la URL del servicio PUSH de android
     * @return string
     */
    public function getAndroidURL()
    {
        return $this->_androidURL;
    }

    /**
     * Declara la URL del servicio PUSH de android
     * @param string $androidURL
     * @return \PushNotifications\Android
     */
    public function setAndroidURL($androidURL)
    {
        $this->_androidURL = $androidURL;
        return $this;
    }

    /**
     * Obtiene el Token de autenticación para producción
     * @return string
     */
    public function getApikey()
    {
        return $this->_apikey;
    }

    /**
     * Declara el Token de autenticación para producción
     * @param string $apikey
     * @return \PushNotifications\Android
     */
    public function setApikey($apikey)
    {
        $this->_apikey = $apikey;
        return $this;
    }

    /**
     * Obtiene el Token de autenticación para Desarrollo
     * @return string
     */
    public function getApikeyDev()
    {
        return $this->_apikeyDev;
    }

    /**
     * Declara el Token de autenticación para Desarrollo
     * @param string $apikeyDev
     * @return \PushNotifications\Android
     */
    public function setApikeyDev($apikeyDev)
    {
        $this->_apikeyDev = $apikeyDev;
        return $this;
    }

    /**
     * Obtiene el UUID del dispositivo al que se le va enviar una notificación
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->_deviceToken;
    }

    /**
     * Declara el UUID del dispositivo al que se le va enviar una notificación
     * + Puede ser un array de UUID's
     * @param string $deviceToken
     * @return \PushNotifications\Android
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
     * @return \PushNotifications\Android
     */
    public function setMessage($message)
    {
        $this->_message = $message;
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
     * @return \PushNotifications\Android
     */
    public function setExtraData(array $extraData)
    {
        $this->_extraData = $extraData;
        return $this;
    }

    /**
     * Obtiene la información de respuesta
     * @return object
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * Declara el cuerpo de la respuesta, la respuesta es un string de json
     * por lo cual, se para por la función json_decode
     * @param string $body
     */
    private function setBody($body)
    {
        $this->_body = json_decode($body);
        return $this;
    }

    /**
     * Obtiene los "headers" de respuesta
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Declara los "headers" de respuesta
     * @param unknown $headers
     */
    private function setHeaders($headers)
    {
        $this->_headers = $headers->getAll();
        return $this;
    }

    /**
     * Obtiene el status code de respuesta
     * @return number
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * Declara el status code de respuesta
     * @param unknown $statusCode
     */
    private function setStatusCode($statusCode)
    {
        $this->_statusCode = $statusCode;
        return $this;
    }

    /**
     * Obtiene el estado de la petición
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->_success;
    }

    /**
     * Declara el estado de la petición
     * @param boolean $success
     */
    private function setSuccess($success)
    {
        $this->_success = $success;
        return $this;
    }

    /**
     * Gestiona el envio de las notificaciones a los servicios de android
     */
    public function send()
    {

        if ($this->isDevMode()) {
            $apiKey = $this->getApikeyDev();
        } else {
            $apiKey = $this->getApikey();
        }

        if (is_null($apiKey)) {
            throw new \Exception('No se a declarado una ApiKey');
        }

        $headers = array(
            'Authorization' => 'key=' . $apiKey,
            'Content-Type' => 'application/json'
        );

        $device = $this->getDeviceToken();
        if (!is_array($device)) {
            $device = array($device);
        }

        $message = array();
        $message['message'] = $this->getMessage();
        $data = array(
            'registration_ids' => $device,
            'data' => $message
        );

        $data = json_encode($data);

        $request = \Requests::post(
            $this->getAndroidURL(),
            $headers,
            $data
        );

        $this->setBody($request->body);
        $this->setHeaders($request->headers);
        $this->setStatusCode($request->success);
        $this->setSuccess($request->success);

        return $this->getSuccess();

    }

}