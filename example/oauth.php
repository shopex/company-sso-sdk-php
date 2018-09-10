<?php
use Shopex\CompanySSO\OAuth;

//example 1
//简单处理方式
$key    = "thisisthekey";
$secret = "thisisthesecret";

$Oauth = new OAuth($key, $secret);
$user = $Oauth->oauth();

return $user;

//example 2
//在复杂系统中推荐使用这种方式
//$request 和$response 为引用系统中的
$oauth = new OAuth($key, $secret);
if($request->has('code'))
{
    $code = $request->get('code');
    return $oauth->codeToUserinfo($code);
} else {
    $redirectUrl = $oauth->getOauthRedirectUrl();
    return $response->redirect($redirectUrl);
}


