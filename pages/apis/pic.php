<?php
// 接受参数
$endpoint_type = isset($_GET['et']) ? sanitizeInput($_GET['et']) : '';  // 终端类型
$time = isset($_GET['time']) ? sanitizeInput($_GET['time']) : ''; // 是否区分时段
$mode = isset($_GET['mode']) ? sanitizeInput($_GET['mode']) : '';   // 响应模式
$source = isset($_GET['source']) ? sanitizeInput($_GET['source']) : '';   // 是否用原图

//处理参数
// 处理$time 
$timeMap = array(
    'true' => 'yt',
    'false' => 'nt'
);
if (array_key_exists($time, $timeMap)) {
    $time = $timeMap[$time];
} else {
    $time = 'nt';
}

// 处理$source
$sourceMap = array(
    'true' => 'source',
    'false' => 'webp'
);
if (array_key_exists($source, $sourceMap)) {
    $source = $sourceMap[$source];
} else {
    $source = 'webp';
}

// 引入模块
include('pages/pic/folderPath.php');
include('pages/' . $api . '/' .  $time . '.php');
?>