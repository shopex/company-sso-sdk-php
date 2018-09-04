<?php
namespace Shopex\CompanySSO;

//这里是所有用到的地址。
//因为有些接口的域名不一致，所以我就不用同一域名了，直接用静态变量得了。反正这个东西要改就大家都修改了
class Links
{

    const SSOServerHost = "ssoauth.ishopex.cn";


//  $auth_page_par = 'response_type=code&client_id=' . $this->client_id . '&redirect_uri=' . urlencode($redirect_uri) . '&state=' . $state;
    const AuthPage = "https://ssoauth.ishopex.cn/oauth/authorize/";

//  $post_data['client_id'] = $this->client_id;
//  $post_data['client_secret'] = $this->client_secret;
//  $post_data['grant_type'] = 'authorization_code';
//  $post_data['redirect_uri'] = $this->getRedirectUri();
//  $post_data['code'] = $code;
    const AccessTokenUrl = "https://ssoauth.ishopex.cn/oauth/access_token/";

//  $page_par = 'client_id=' . $this->client_id . '&redirect_uri=' . urlencode($redirect_uri);
    const LogoutUrl = "https://ssoauth.ishopex.cn/oauth/logout/";

}

