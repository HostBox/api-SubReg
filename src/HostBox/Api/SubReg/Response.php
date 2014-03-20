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
        $this->response = $response;
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
            if (!array_key_exists('error', $response)) {
                throw new RuntimeException('Response with error status has not error message');
            }

            $error = $response['error'];
            $codes = implode(':', array_values($error['errorcode']));
            throw new LogicException('Response error [' . $codes . ']: ' . $error['errormsg']);
        }
    }

    /** @return mixed */
    public function getData() {
        return isset($this->response['data']) ? $this->response['data'] : NULL;
    }

    /**
     * @param string $key
     * @throws Exceptions\LogicException
     * @return mixed|null
     */
    public function get($key) {
        $data = $this->getData();
        if ($data === NULL) {
            throw new LogicException('Response has not data section');
        }

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return NULL;
    }

}
