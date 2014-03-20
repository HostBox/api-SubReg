<?php

namespace HostBoxTests\Api\SubReg;

use HostBox\Api\SubReg\Config;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';


class ConnectionTest extends Tester\TestCase {

    public function testProduction() {
        $config = new Config('test', '123456');
        Assert::equal(Config::DEFAULT_URL_PRODUCTION, $config->getUrl());
    }

    public function testSandbox() {
        $config = new Config('test', '123456', FALSE);
        Assert::equal(Config::DEFAULT_URL_SANDBOX, $config->getUrl());
    }

}

\run(new ConnectionTest());
