<?php

class JSSDK
{
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function connectsql()
    {
        $dbhost = "localhost";
        $username = "root";
        $userpass = "admin";
        $dbdatabase = "market";
        $db_connect = mysql_connect($dbhost, $username, $userpass) or die("Unable to connect to the MySQL!");
        mysql_select_db($dbdatabase, $db_connect);
        return $db_connect;
    }

    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        $db_connect = $this->connectsql();
        $result = mysql_query("SELECT * FROM zjc_system WHERE type=1");
        $row = mysql_fetch_row($result);
        $createtime = date("Y-m-d H:i:s", time());
        if ($row == "") {
            $ticket = $this->getJsApiTicket2();
            mysql_query("INSERT INTO system (type,value,createtime,updatetime) VALUES (1, '$ticket', '$createtime', '$createtime')");
        } else {
            $lasttime = strtotime($row[4]);
            if ($lasttime + 7000 <= time()) {
                $ticket = $this->getJsApiTicket2();
                $result = mysql_query("UPDATE system SET updatetime='" . date("Y-m-d H:i:s", time()) . "', value='" . $ticket . "' WHERE type=1");
                //$result = mysql_query("UPDATE zjc_system SET value='". $access_token."' WHERE id = 11");
            } else {
                $ticket = $row[2];
            }
        }
        mysql_close($db_connect);
        return $ticket;
    }

    private function getJsApiTicket2()
    {
        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
        $res = json_decode($this->httpGet($url));
        $ticket = $res->ticket;
        return $ticket;
    }

    private function get_access_token2()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx951ac1092ad9a5bf&secret=4918f8fab950eddfba7e985f76a97b46';
        $access_token_tmp = file_get_contents($url);
        $result = json_decode($access_token_tmp, true);
        $access_token = $result['access_token'];
        return $access_token;
    }

    private function getAccessToken() {
        $db_connect=$this->connectsql();
        $result=mysql_query("SELECT * FROM msystem WHERE type = 0");
        $row=mysql_fetch_row($result);
        $createtime = date("Y-m-d H:i:s",time());
        if($row == ""){
            $access_token = $this->get_access_token2();
            mysql_query("INSERT INTO msystem (type,value,createtime,updatetime) VALUES (0, '$access_token', '$createtime', '$createtime')");
        }else{
            $lasttime = strtotime($row[4]);
            if($lasttime+7000 <= time()){
                $access_token = $this->get_access_token2();
                $result = mysql_query("UPDATE msystem SET updatetime='".date("Y-m-d H:i:s",time())."', value='". $access_token."' WHERE type=0");
            }else {
                $access_token = $row[2];
            }
        }
        mysql_close($db_connect);
        return $access_token;
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}


