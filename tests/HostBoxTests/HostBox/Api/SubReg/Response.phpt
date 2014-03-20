<?php

namespace HostBoxTests\Api\SubReg;

use HostBox\Api\SubReg\Response;
use Tester\Assert;
use Tester;

require_once __DIR__ . '/../../../bootstrap.php';


class ResponseTest extends Tester\TestCase {

    public function testCheckStatus() {
        Assert::exception(function () {
            new Response(array('foo' => 'bar'));
        }, 'RuntimeException');

        Assert::exception(function () {
            new Response(array('status' => "error"));
        }, 'RuntimeException');

        Assert::exception(function () {
            new Response(array(
                'status' => "error",
                'error' => array(
                    'errormsg' => "Incorrect username or password",
                    'errorcode' => array(
                        'major' => 500,
                        'minor' => 104)
                )));
        }, 'LogicException', 'Response error [500:104]: Incorrect username or password');

        Assert::exception(function () {
            new Response(array('status' => "error"));
        }, 'RuntimeException');
    }

    public function testGet() {
        Assert::exception(function () {
            $response = new Response(array('status' => "ok"));
            $response->get('unknown');
        }, 'LogicException');

        $response = new Response(array(
            'status' => "ok",
            'data' => array(
                'name' => 'domain.or.af',
                'avail' => 1
            )));
        Assert::equal(1, $response->get('avail'));
    }

}

\run(new ResponseTest());
