<?php
header("Content-Type: text/html;charset=utf-8");

$appid = 'wx951ac1092ad9a5bf';
$secret = '4918f8fab950eddfba7e985f76a97b46';
function getToken($uid){
        $mysql_server_name="localhost"; //数据库服务器名称
        $mysql_username="root"; // 连接数据库用户名
        $mysql_password="admin"; // 连接数据库密码
        $mysql_database="market";
        $conn=mysql_connect($mysql_server_name, $mysql_username,
            $mysql_password)or die("Unable to connect to the MySQL!");
        $strsql = "select * from user where token='$tokenstr'";
        while(1){
            $tokenstr = md5(time() . mt_rand(1,1000000));
            $result = mysql_db_query($mysql_database, $strsql, $conn);
            $row=mysql_fetch_row($result);
            if(empty($row)){
                mysql_free_result($result);
                mysql_close($conn);
                $strsql = "update user set token = '$tokenstr' where uid='$uid';" ;
                $result = mysql_db_query($mysql_database, $strsql, $conn);
                mysql_free_result($result);
                mysql_close($conn); 
                return $tokenstr;
            }
        }
    }


    $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='. $appid .'&secret='. $secret. '&code=' . $_GET['code'] . '&grant_type=authorization_code';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);  
    $res_tmp = json_decode($res, true);
    $openid = $res_tmp['openid'];
    $mysql_server_name="localhost"; //数据库服务器名称
    $mysql_username="root"; // 连接数据库用户名
    $mysql_password="admin"; // 连接数据库密码
    $mysql_database="market"; // 数据库的名字
    $conn=mysql_connect($mysql_server_name, $mysql_username,
        $mysql_password)or die("Unable to connect to the MySQL!");
    $strsql = "select * from user where openid='$openid'";
    // echo $strsql;
    $result = mysql_db_query($mysql_database, $strsql, $conn);
    $row=mysql_fetch_row($result);
    if(empty($row)){
        setcookie('market_openid',$openid);
        $url1 = "http://www.jasper-website.site/market/index.php/Home/Index/login.html";
    }else{
        $url = $_SERVER['PHP_SELF'];
        $temp = explode('/',$url);
        $token = getToken($row[0]);
        setcookie('market_usertoken',$token,time()+3600,"/market");
        setcookie('market_uid',$row[0],time()+3600,"/market");
        if($temp[3] == 'togooddetail'){
            $url1 = "http://www.jasper-website.site/market/index.php/Home/Main/goodsdetail/gid/$temp[4]";
        }elseif($temp[3] == 'orderdetail_g'){
            $url1 = "http://www.jasper-website.site/market/index.php/Home/User/userorderdetail/ooid/$temp[4]";
        }elseif($temp[3] == 'orderdetail_u'){
            $url1 = "http://www.jasper-website.site/market/index.php/Home/Main/orderdetail/ooid/$temp[4]";
        }elseif($temp[3] == 'map'){
            $url1 = "http://www.jasper-website.site/market/index.php/Home/Index/baidu_map/latitude/$temp[5]/longitude/$temp[4]/uphone/$temp[6]";
        }elseif($temp[3] == 'auth'){
            $url1 = "http://www.jasper-website.site/market/index.php/Home/admin/auth/openid/$openid";
        }else{
            $url1 = "http://www.jasper-website.site/market/index.php/Home/Main/main";
        }
    }
    mysql_free_result($result);
    mysql_close($conn);  
    header("location: $url1");



    ?>