<?php
// 引入错误报告
error_reporting(E_ALL);

// 定义一个用于清理和验证输入的函数
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>