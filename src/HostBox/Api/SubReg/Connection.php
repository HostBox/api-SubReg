<?php

namespace HostBox\Api\SubReg;

use SoapClient;


class Connection {

    /** @var SoapClient */
    private $soapClient;

    /** @var string */
    private $ssid;


    public function __construct(Config $config) {
        $this->soapClient = new SoapClient(NULL, array(
            "location" => $config->getUrl() . "/cmd.php",
            "uri" => $config->getUrl() . "/soap"
        ));

        $response = $this->request('Login', array(
            "login" => $config->getLogin(),
            "password" => $config->getPassword(),
        ));

        $this->ssid = $response->get('ssid');
    }

    /**
     * @param string $command
     * @param mixed $parameters
     * @return Response
     */
    public function request($command, $parameters = array()) {
        if ($this->isAuthorized()) {
            $parameters['ssid'] = $this->ssid;
        }

        return new Response($this->call($command, array(
            'data' => $parameters
        )));
    }

    /**
     * @param string $command
     * @param array $params
     * @return array
     */
    public function call($command, $params) {
        return $this->soapClient->__call($command, $params);
    }

    /** @return bool */
    private function isAuthorized() {
        return $this->ssid !== NULL;
    }

}
