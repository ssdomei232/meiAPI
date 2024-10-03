<?php
// 定义时间段和文件夹映射
$timeFolders = [
    ['start' => 0, 'end' => 7, 'folder' => 'dark'],
    ['start' => 7, 'end' => 19, 'folder' => 'light'],
    ['start' => 19, 'end' => 24, 'folder' => 'dark'],
]; 

// 验证时间区间配置是否有效
function validateTimeFolders($timeFolders) {
    foreach ($timeFolders as $i => $timeFrame) {
        if (!isset($timeFrame['start'], $timeFrame['end'], $timeFrame['folder'])) {
            throw new Exception("Invalid time frame structure at index $i");
        }
        if (!is_int($timeFrame['start']) || !is_int($timeFrame['end'])) {
            throw new Exception("Invalid time frame start or end values at index $i");
        }
        if ($timeFrame['start'] >= $timeFrame['end']) {
            throw new Exception("Invalid time frame range at index $i: start must be less than end");
        }
    }
}

try {
    // 验证时间区间配置
    validateTimeFolders($timeFolders);

    // 获取当前小时数
    $currentHour = date('G');

    // 初始化selectedFolder为null
    $selectedFolder = null;

    // 遍历时间区间数组
    foreach ($timeFolders as $timeFrame) {
        // 检查当前时间是否在区间内
        if ($currentHour >= $timeFrame['start'] && $currentHour < $timeFrame['end']) {
            $selectedFolder = $timeFrame['folder'];
            break; // 如果找到匹配项，停止循环
        }
    }
} catch (Exception $e) {
    // 处理任何发生的异常
    echo "Error: " . $e->getMessage();
}

if (!$selectedFolder) {
    die("无法识别当前时间段的图片文件夹。");
}
$folderPath = $folderPath . $selectedFolder;
$images = [];
if ($handle = opendir($folderPath)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $images[] = $entry;
        }
    }
    closedir($handle);
} else {
    die("无法打开目录: " . $folderPath);
}

// 拼接路径
if (count($images) > 0) {
    $randomImage = $images[array_rand($images)];
    $imageUrl = $baseURL . $folderPath . '/' . $randomImage;  
    $push_path = $folderPath . '/' . $randomImage;
} else {
    echo "ERROR,NO IMAGE";
}

// 返还数据
if (empty($mode)) {
    header('Content-Type: image/jpeg');
    header('Content-Length: ' . filesize($push_path));
    readfile($push_path);
    exit;
}
elseif ($mode == 'json') {
    header('Content-Type: application/json');
    echo json_encode(['code' => 200,'image_url' => $imageUrl,'theme' => $selectedFolder,'endpoint_type' => $endpoint_type,'now' => date('H'),'mode' => 'json']);
    exit;
}
elseif ($mode == 'redirect') {
    header('Location: ' . $imageUrl);
    exit;
}
else {
    header('Location: ' . $imageUrl);
    exit;
}
?>