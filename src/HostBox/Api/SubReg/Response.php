<?php

namespace HostBox\Api\SubReg;

use HostBox\Api\SubReg\Exceptions\LogicException;
use HostBox\Api\SubReg\Exceptions\RuntimeException;


class Response {

    /** @var array */
    private $response;


    /** @param array $response */
    public function __construct(array $response) {
        $this->checkStatus($response);
        $this->data = $response;
    }

    /**
     * @param array $response
     * @throws Exceptions\RuntimeException
     * @throws Exceptions\LogicException
     */
    private function checkStatus(array $response) {
        if (!isset($response['status']))
            throw new RuntimeException('Response status is missing');

        if ($response['status'] == 'error') {
            throw new LogicException('Response error: ' . $response['error']['errormsg']);
        }
    }

    /** @return mixed */
    public function getData() {
        return $this->response['data'];
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key) {
        if (array_key_exists($key, $data = $this->getData())) {
            return $data[$key];
        }

        return NULL;
    }

}
