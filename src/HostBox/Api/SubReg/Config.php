<?php

namespace HostBox\Api\SubReg;


class Config implements IConfig {

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var bool */
    private $production;

    /** @var string */
    protected $urlProduction = self::DEFAULT_URL_PRODUCTION;

    /** @var string */
    protected $urlSandbox = self::DEFAULT_URL_SANDBOX;


    /**
     * @param string $login
     * @param string $password
     * @param bool $production
     */
    public function __construct($login, $password, $production = TRUE) {
        $this->login = $login;
        $this->password = $password;
        $this->production = $production;
    }

    /** @return string */
    public function getLogin() {
        return $this->login;
    }

    /** @return string */
    public function getPassword() {
        return $this->password;
    }

    /** @return bool */
    public function isProduction() {
        return $this->production === TRUE;
    }

    /** @return string */
    public function getUrl() {
        return $this->isProduction() ? $this->urlProduction : $this->urlSandbox;
    }

}
