<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/17
 * Time: 14:59
 */
return array(
    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING'=>array(
//        '__PUBLIC__'=>__ROOT__.'/'.'Application'.'/Public',
//        '__CSS__'=>__ROOT__.'/'.'Application'.'/Public/css',
//        '__JS__'=>__ROOT__.'/'.'Application'.'/Public/js',
        '__IMAGE__'=>__ROOT__.'/Public/images',
//        '__PUBLICATTACHPATH__'=>__ROOT__.'/Public/Uploads',
//        '__PUBLICALL__'=>__ROOT__.'/'.'Application'.'/Purchaser/Public',
//        '__IMAGEPUBLIC__'=>'Public/Uploads/image',
        '__PATHHPROSE__'=>'/market',	//注册在kindeditor(php文件夹的upload_json.php)中也调用，如果变更需要同步修改
        '__ROOTURL__'=>__ROOT__.'/index.php/Home',
    ),

    //获取页面TOKENNAME
    'TOKENNAME'=>'market.tokenstr',   //注册在kindeditor（php文件夹的upload_json.php）中也调用，如果变更需要同步修改
    'TOKENPATH'=>'/',

    //自定义变量
    'SMALLPAGESIZE' 	=> 5, //少量分页长度
    'PAGESIZE'			=> 10, //常规分页长度
    'BIGPAGESIZE' 		=> 20, //大量分页长度
    'MAXRETURNNUMBER'	=> 50, //大量返回记录条数

    'URL_CASE_INSENSITIVE' =>false,//大小写不敏感

);
