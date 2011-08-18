<?php
/*
最基本/最常用的 PEAR::Cache_Lite 使用方法
$cacheId, $cacheOption 是必要的
更多的使用方法可以参照官网介绍
当然您也可以直接查看 Cache_Lite 源代码
*/

require_once('inc/Lite.php');
$cacheId = 'test.php';
$cacheOption = array(
    'cacheDir' => 'tmp/',
    'lifeTime' => 10
);
$cacheObj = new Cache_Lite($cacheOption);
$cacheData = $cacheObj->get($cacheId);
if (!$cacheData) {
    echo "我要开始创建缓存啦! ";
    $cacheData = "这是一些缓存内容, 当前时间: ".date("Y-m-d H:i:s");
    $cacheFlag = $cacheObj->save($cacheData);
    if(!$cacheFlag) {
        exit("缓存创建失败!");
    }
}

echo $cacheData;
?>