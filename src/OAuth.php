<?php
namespace Shopex\CompanySSO;

use Shopex\CompanySSO\Links;

class OAuth
{

    private $key = "";

    private $secret = "";

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /****
     * 在实用中，这个方法最好重写
     */
    public function oauth($code = null,$isWorkWechat = false)
    {
        if($code || $this->getCode())
        {
            $code = $code ? : $this->getCode();
            return $this->codeToUserinfo($code);
        } else {
            $redirectUrl = $this->getOauthRedirectUrl();
            return $this->redirect($redirectUrl);
        }

    }

    public function getOauthRedirectUrl($redirectUrl = "", $state = "")
    {

    }

}
