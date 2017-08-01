<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "zhuojin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
//$wechatObj->valid();

class wechatCallbackapiTest
{
    /*public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
      }*/

      public function responseMsg()
      {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

          //extract post data
        if (!empty($postStr)){

          $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
          $RX_TYPE = trim($postObj->MsgType);

          switch($RX_TYPE)
          {
            case "text":
            $resultStr = $this->handleText($postObj);
            break;
            case "event":
            $resultStr = $this->handleEvent($postObj);
            break;
            default:
            $resultStr = "Unknow msg type: ".$RX_TYPE;
            break;
          }
          echo $resultStr;
        }else {
          echo "";
          exit;
        }
      }

      public function handleText($postObj)
      {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        <FuncFlag>0</FuncFlag>
      </xml>";             
      if(!empty( $keyword ))
      {
        $msgType = "text";

        if($keyword=="你好"){
          $contentStr = "hello";
        }else{
          $contentStr = "MADE BY JASPER JIANG";
        }
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
      }else{
        echo "Input something...";
      }
    }

    public function handleEvent($object)
    {
      $contentStr = "";
      switch ($object->Event)
      {
        case "subscribe":
          $contentStr = "感谢关注二手商城-MADE BY JASPER JIANG";
        break;
        case "SCAN":
          $contentStr = "扫描 ".$object->EventKey;
          // header("Location: http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://120.27.34.165/market/oauth2.php/togooddetail/$object->EventKey&response_type=code&scope=snsapi_base&state=STATE"); 
          $contentStr[] = array("Title"=>"该产品检测结果为正品", "Description"=>"书名：微信公众平台开发最佳实践\n定价：￥69.00\n作者：方倍工作室\n\n点击“查看全文”，使用微信支付在线购买", "PicUrl"=>"http://images.cnitblog.com/i/340216/201404/301756448922305.jpg", "Url" =>"http://mm.wanggou.com/item/jd2.shtml?sku=11447844");
        break;
        default :
          $contentStr = "Unknow Event: ".$object->Event;
        break;
      }
      $resultStr = $this->responseText($object, $contentStr);
      return $resultStr;
    }
    
    public function responseText($object, $content, $flag=0)
    {
      $textTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[text]]></MsgType>
      <Content><![CDATA[%s]]></Content>
      <FuncFlag>%d</FuncFlag>
    </xml>";
    $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
    return $resultStr;
  }


  private function checkSignature()
  {
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];    

    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );

    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }
}

?>