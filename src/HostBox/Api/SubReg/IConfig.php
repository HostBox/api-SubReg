<?php

namespace HostBox\Api\SubReg;


interface IConfig {

    const
        DEFAULT_URL_PRODUCTION = 'https://soap.subreg.cz',
        DEFAULT_URL_SANDBOX = 'https://ote-soap.subreg.cz';


    /** @return string */
    public function getLogin();

    /** @return string */
    public function getPassword();

    /** @return bool */
    public function isProduction();

    /** @return string */
    public function getUrl();

}
