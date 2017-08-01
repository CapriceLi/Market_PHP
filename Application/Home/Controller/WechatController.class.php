<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class WechatController extends Controller {
    public function index(){
        $token = "weixin";
        $wechat = new Wechat($token);

        $data=$wechat->request();
        if($data && is_array($data)){
            switch ($data['MsgType']) {
                case 'text':
                $this->Text($wechat,$data);
                break;
                case 'event':
                $this->Event($wechat,$data);
                break;
                case 'voice':
                $this->Voice($wechat,$data);
                break;
            }

        }
    }
    public function test(){
        $date = date("Y-m-d",time());
        $sql = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=morder.uid and user.openid=12345 and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1 ";
        $result = M()->query($sql);
        for($i=0;$i<count($result);$i++){
            $aid = explode(',', $result[$i]['attach']);
            $aid = $aid[0];
            $title="订单号:".$result[$i]['ooid'];
            $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
            $picurl = "http://120.27.34.165/market".$picurl;
            $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$result[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
            $discription="交易地点:";
            $content[] = [$title,$discription,$url,$picurl];
        }
        // echo $content[0][0];
    }
    //回复文本消息
    private function Text($wechat,$data){
        if($data['Content'] == "test"){
            $content = array(); 
            $content[] = ["微信公众平台开发教程","","",""];
            $content[] = ["微信公众平台开发教程2","这是discribe","www.baidu.com","http://g.hiphotos.bdimg.com/wisegame/pic/item/3166d0160924ab186196512537fae6cd7b890b24.jpg"];
            $content[] = ["微信公众平台开发教程3","这是discribe","www.baidu.com","http://g.hiphotos.bdimg.com/wisegame/pic/item/3166d0160924ab186196512537fae6cd7b890b24.jpg"];
            $wechat->replyNews2($content);
        }
        $reg_order = '/.*搜索.*今天.*交易.*/';
        $openid = $data['FromUserName'];
        if(preg_match_all($reg_order,$data['Content']) == 1){
            $date = date("Y-m-d",time());
            $sql = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=morder.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1";
            $sql2 = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=goods.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1 ";
            $result = M()->query($sql);
            $result2 = M()->query($sql2);
            $content = array();
            if(!empty($result)){
                $content[] = ["我购买的商品","","",""];
                for($i=0;$i<count($result);$i++){
                    $aid = explode(',', $result[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result[$i]['ooid']."\n商品名:".$result[$i]['name']."\n交易地点:".$result[$i]['provname']." ".$result[$i]['cityname']. " ".$result[$i]['address']."\n交易时间:".$result[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$result[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }
            if(!empty($result2)){
                $content[] = ["我购出的商品","","",""];
                for($i=0;$i<count($result2);$i++){
                    $aid = explode(',', $result2[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result2[$i]['ooid']."\n商品名:".$result2[$i]['name']."\n交易地点:".$result2[$i]['provname']." ".$result2[$i]['cityname']. " ".$result2[$i]['address']."\n交易时间:".$result2[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$result2[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }
            if(empty($result2)&&empty($result)){
                $wechat->replyText("今天没有交易");
            }
            $wechat->replyNews2($content);
        }else{
            $wechat->replyText("不理解您所说的，如果您想要查询今天的交易请说：“搜索今天的交易”");
        }

    }
    //处理事件
    private function Event($wechat,$data){
        switch ($data['Event']){
            case 'SCAN':
            $gid = $data['EventKey'];
            $sql = "select name,attach,goods.describe from goods where gid=$gid";
            $goods = M()->query($sql);
            $goods = $goods[0];
            $aid = explode(',', $goods['attach']);
            $aid = $aid[0];

            $title=$goods['name'];
            $discription=$goods['describe'];
            $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/togooddetail/$gid&response_type=code&scope=snsapi_base&state=STATE";
            $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
            $picurl = "http://120.27.34.165/market".$picurl;
            $wechat->replyNewsOnce($title, $discription, $url, $picurl);
            break;
            case 'CLICK':
            $this->Click($wechat,$data);
            break;
        }
    }
    private function Voice($wechat,$data){
        $openid = $data['FromUserName'];
        $reg_order = '/.*搜索.*今天.*交易.*/';
        if(preg_match_all($reg_order,$data['Recognition']) == 1){
            $date = date("Y-m-d",time());
            $sql = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=morder.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1 ";
            $sql2 = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=goods.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1 ";
            $result = M()->query($sql);
            $result2 = M()->query($sql2);
            $content = array();
            if(!empty($result)){
                $content[] = ["我购买的商品","","",""];
                for($i=0;$i<count($result);$i++){
                    $aid = explode(',', $result[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result[$i]['ooid']."\n商品名:".$result[$i]['name']."\n交易地点:".$result[$i]['provname']." ".$result[$i]['cityname']. " ".$result[$i]['address']."\n交易时间:".$result[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$result[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }
            if(!empty($result2)){
                $content[] = ["我购出的商品","","",""];
                for($i=0;$i<count($result2);$i++){
                    $aid = explode(',', $result2[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result2[$i]['ooid']."\n商品名:".$result2[$i]['name']."\n交易地点:".$result2[$i]['provname']." ".$result2[$i]['cityname']. " ".$result2[$i]['address']."\n交易时间:".$result2[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$result2[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }
            if(empty($result2)&&empty($result)){
                $wechat->replyText("今天没有交易");
            }
            $wechat->replyNews2($content);
        }else{
            $wechat->replyText("不理解您所说的，如果您想要查询今天的交易请说：“搜索今天的交易”");
        }
    }
    private function Click($wechat,$data){
        $openid = $data['FromUserName'];
        switch ($data['EventKey']) {
            case 'order1':
            $date = date("Y-m-d",time());
            $sql = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=morder.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1";
            $result = M()->query($sql);
            $content = array();
            if(!empty($result)){
                $content[] = ["我购买的商品","","",""];
                for($i=0;$i<count($result);$i++){
                    $aid = explode(',', $result[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result[$i]['ooid']."\n商品名:".$result[$i]['name']."\n交易地点:".$result[$i]['provname']." ".$result[$i]['cityname']. " ".$result[$i]['address']."\n交易时间:".$result[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$result[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }else{
                $wechat->replyText("今天没有交易");
            }
            $wechat->replyNews2($content);
            break;
            case 'order2':
            $date = date("Y-m-d",time());
            $sql2 = "select goods.name,morder.*,goods.attach,dict_city.cityname,dict_province.provname from morder,goods,user,dict_city,dict_province where dict_city.cityid=morder.cityid and dict_province.provid=morder.provid and user.uid=goods.uid and user.openid='$openid' and morder.gid=goods.gid and tradetime like '$date%' and morder.state=1";
            $result2 = M()->query($sql2);
            $content = array();
            if(!empty($result2)){
                $content[] = ["我购出的商品","","",""];
                for($i=0;$i<count($result2);$i++){
                    $aid = explode(',', $result2[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result2[$i]['ooid']."\n商品名:".$result2[$i]['name']."\n交易地点:".$result2[$i]['provname']." ".$result2[$i]['cityname']. " ".$result2[$i]['address']."\n交易时间:".$result2[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$result2[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }else{
                $wechat->replyText("今天没有交易");
            }
            $wechat->replyNews2($content);
            break;
            case 'myorder':
            $sql = "select morder.*,goods.name,goods.attach from morder,goods,user where morder.gid=goods.gid and goods.uid = user.uid and morder.state=0 and user.openid='$openid' order by morder.state,morder.tradetime DESC,morder.createtime DESC";
            $result = M()->query($sql);
            $content = array();
            if(!empty($result)){
                $content[] = ["我要确认的订单","","",""];
                for($i=0;$i<count($result);$i++){
                    $aid = explode(',', $result[$i]['attach']);
                    $aid = $aid[0];
                    $title="订单号:".$result[$i]['ooid']."\n商品名:".$result[$i]['name']."\n交易地点:".$result[$i]['provname']." ".$result[$i]['cityname']. " ".$result[$i]['address']."\n交易时间:".$result[$i]['tradetime'];
                    $picurl = M('attach')->where(array('aid'=>$aid))->getfield('url');
                    $picurl = "http://120.27.34.165/market".$picurl;
                    $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$result[$i]['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
                    $content[] = [$title,$discription,$url,$picurl];
                }
            }else{
                $wechat->replyText("没有我要确认的订单");
            }
            $wechat->replyNews2($content);
            break;
        }
    }
}