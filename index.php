<?php
// 安全部分
include('pages/safe/waf.php');

// 定义基本设置
$baseURL = 'https://api.mmeiblog.cn/';
$git_commits = "";
$umami= '';

// 获取参数
$api = isset($_GET['api']) ? sanitizeInput($_GET['api']) : '';  // API类型

// 判断使用的API
// 首页
if (empty($api)){
    include('pages/home.php');
}
// 如果是图片API
elseif ($api == 'pic'){
    include('pages/apis/pic.php');
}
// 特殊API
elseif ($api == 'fox'){
    include('pages/' . $api . '.php');
}
else {
    header('Content-Type: application/json');
    echo json_encode(['code' => 404,'data' => 'Not Found']);
    exit;
}
?>
