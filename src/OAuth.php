<?php
namespace Shopex\CompanySSO;

use Shopex\CompanySSO\Links;
use Shopex\CompanySSO\Requester;

class OAuth
{

    private $key = "";

    private $secret = "";

    private $requester = "";

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->requester = new Requester($key, $secret);
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
        $params = [
            'response_type' => "code",
            'client_id' => $this->key,
            'redirect_uri' => $redirectUrl ? : $this->getUri(),
            'state' => $this->genState()
        ];
        $url = Links::AuthPage . "?" . http_build_query($params);

        return $url;
    }

    public function codeToUserinfo($code)
    {
        $params = [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->getUri()
        ];
        $userInfo = $this->requester->rpcCall("POST", Links::AccessTokenUrl, $params);
        return $userInfo;
    }

    //获取当前页面的请求地址
    private function getUri()
    {
        $uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if(strstr($_SERVER['SERVER_PROTOCOL'],"HTTPS"))
            return "https://" . $uri;
        return "http://" . $uri;
    }

    private function redirect($url)
    {
        header("location:$url");
        echo "正在获取授权...";
        exit;
    }

    private function genState()
    {
        $state = md5($this->getRandomStr(8) . time());
        return $state;
    }

    private function getRandomStr($len){
        $base_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = "";
        for ( $i = 0; $i < $len; $i++ ){
            $str .= $base_str[ mt_rand(0, strlen($base_str) - 1) ];
        }
        return $str;
    }


}
