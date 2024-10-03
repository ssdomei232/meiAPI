<?php
// 处理$time 
$timeMap = array(
    'true' => 'yt',
    'false' => 'nt'
);
if (array_key_exists($time, $timeMap)) {
    $time = $timeMap[$time];
} else {
    // 默认值
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
    // 默认值
    $source = 'webp';
}
?>