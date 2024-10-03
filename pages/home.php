<?php
function countWebpFilesInDirectory($directory) {
    $totalWebpFiles = 0;
    if ($handle = opendir($directory)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $fullPath = $directory . '/' . $entry;
                // 检查是否为目录
                if (is_dir($fullPath)) {
                    $totalWebpFiles += countWebpFilesInDirectory($fullPath);
                } else {
                    // 检查文件扩展名是否为 .webp
                    if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'webp') {
                        $totalWebpFiles++;
                    }
                }
            }
        }
        closedir($handle);
    }
    return $totalWebpFiles;
}
// 指定要统计的目录
$directoryToCount_pc = './files/pic/pc/nt'; 
$directoryToCount_phone = './files/pic/phone/nt'; 
$pic_number_pc = countWebpFilesInDirectory($directoryToCount_pc);
$pic_number_phone = countWebpFilesInDirectory($directoryToCount_phone);
$pic_number = $pic_number_pc + $pic_number_phone;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>mei API</title>
        <link rel="stylesheet" href="/pages/assets/css/style.css">
        <link rel="stylesheet" href="//at.alicdn.com/t/c/font_4536557_e64emmx4sxm.css">
        <link rel="shortcut icon" href="https://api.mmeiblog.cn/?api=favicon">
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <?php echo $umami; ?>
    </head>
<body>
<div class="container">
<div class="vertical-line"></div>
    <!-- 侧边栏 -->
    <div class="sidebar" id="sidebar">
        <div class="menu-item" onclick="showContent('home')">
        <span class="iconfont icon-shouye" style="font-size:17px;"></span>
        &emsp;首页
        </div>

        <p>&emsp;<small>图片API</small></p>

        <div class="menu-item" onclick="showContent('pic')">
        <span class="iconfont icon-tupian" style="font-size:17px;color:#158b8f;"></span>
        &emsp;随机图片
        </div>

        <div class="menu-item" onclick="showContent('pict-list')">
        <span class="iconfont icon-jianfangtuji_click" style="font-size:20px;color:#00B570;"></span>
        &emsp;图片列表
        </div>
        
    </div>

    <!-- 内容 -->
    <div class="content">
        <!-- 首页 -->
        <div>
            <center>
                <h2>mei API</h2>
            </center>
            <div class="text">
                <h4>网站简介</h4>
                <p>欢迎使用 <code>mei API</code>,由 mei 开发并维护</p>
                <p>用于实践我最新学到的技术,也能勉强保证服务可用性(但被打了可扛不住)</p>
                <p>如果你觉得这个API有什么不完善的地方或者说你有什么更好的想♂法，可以发送邮箱至 <a href=mailto:i@mmeiblog.cn>i@mmeiblog.cn</a>。</p>
            </div>
            </br></br>
            <div class="text">
                <h4><span class="iconfont icon-gonggao" style="font-size:20px;color:#515B77;"></span>&emsp;站点公告</h4>
            </div>
            </br></br>
            <div class="text">
                <h4><span class="iconfont icon-youlian" style="font-size:20px;"></span>&emsp;友情链接</h4>
                <p><a href="https://mei.lv">mei的网络日志</a></p>
            </div>
            <p style="text-align: right;"><small><span class="iconfont icon-git-fenzhi-tianchong" style="font-size:15px"></span><?php echo $git_commits; ?></small></p>
        </div>

        <div id="home" style="display:none;">
        <center>
            <h2>mei API</h2>
            </center>
            <div class="text">
                <h4>网站简介</h4>
                <p>欢迎使用 <code>mei API</code>,由 mei 开发并维护</p>
                <p>用于实践我最新学到的技术,也能勉强保证服务可用性(但被打了可扛不住)</p>
                <p>如果你觉得这个API有什么不完善的地方或者说你有什么更好的想♂法，可以发送邮箱至 <a href=mailto:i@mmeiblog.cn>i@mmeiblog.cn</a>。</p>
            </div>
            </br></br>
            <div class="text">
                <h4><span class="iconfont icon-gonggao" style="font-size:20px;color:#515B77;"></span>&emsp;站点公告</h4>
            </div>
            </br></br>
            <div class="text">
                <h4><span class="iconfont icon-youlian" style="font-size:20px;"></span>&emsp;友情链接</h4>
                <p><a href="https://mei.lv">mei的网络日志</a></p>
            </div>
            <p style="text-align: right;"><small><span class="iconfont icon-git-fenzhi-tianchong" style="font-size:15px"></span><?php echo $git_commits; ?></small></p>
        </div>

        <!-- 随机图片 -->
        <div id="pic" style="display:none;">
            <center>
                <h1>随机图片 API</h1>
                <p>此 API 提供随机二次元图片，不定期更新！</p>
                <p><small>由于压缩脚本编写时的一点啸问题，部分原图为png格式的图片可能没有被压缩...</small></p>
                <p>原则上本站不禁止爬虫,但如果你想要图的话我可以直接发给你</p>
                <p>图片总数:<?php echo $pic_number; ?></p>
            </center>
            <div class="text">
                <h2>
                <span class="iconfont icon-lianjie" style="font-size:28px;color:#1677FF;"></span>
                API 地址
                </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>适用设备</th>
                                <th>请求方式</th>
                                <th>请求地址</th>
                                <th>说明</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>手机</td>
                                <td>GET</td>
                                <td><a href="phone">/phone</a></td>
                                <td>竖屏随机图片API</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>电脑</td>
                                <td>GET</td>
                                <td><a href="pc">/pc</a></td>
                                <td>横屏随机图片API</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>All</td>
                                <td>GET</td>
                                <td><a href="favicon">/favicon</a></td>
                                <td>获取本站favicon</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>All</td>
                                <td>GET</td>
                                <td><a href="bj">/bj</a></td>
                                <td>获取静态页面装饰图</td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>All</td>
                                <td>GET</td>
                                <td><a href="fox">/fox</a></td>
                                <td>获取狐狸图</td>
                            </tr>
                        </tbody>
                    </table>
            </div>

            </br></br>

            <div class="text"> 
                <h2>
                <span class="iconfont icon-_canshu_xiugaicanshudingyi" style="font-size:25px;"></span>
                参数列表
                </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>参数</th>
                                <th>值</th>
                                <th>说明</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>time</td>
                                <td>Boolean</td>
                                <td>是否区分时段,默认为<code>false</code></td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>mode</td>
                                <td>String</td>
                                <td>填<code>json</code>则返回一串数组;填<code>redirect</code>则会重定向至图片URL;不填则返回一张图片</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>source</td>
                                <td>Boolean</td>
                                <td>是否使用原图(加载较慢),默认为<code>false</code></td>
                            </tr>
                        </tbody>
                    </table>
            </div>

            </br></br>

            <div class="text">
                <h2>
                <span class="iconfont icon-icon--fanhui" style="font-size:25px;color:#1677FF;"></span>
                返回数据
                </h2>
                <table>
                        <thead>
                            <tr>
                                <th>#</td>
                                <th>数据</td>
                                <th>说明</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>code</td>
                                <td>状态码</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>image_url</td>
                                <td>图片地址</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>theme</td>
                                <td>明暗主题</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>endpoint_type</td>
                                <td>适用设备</td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>now</td>
                                <td>现在的时间</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>mode</td>
                                <td>输出模式</td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>

        <!-- 图片列表 -->
        <div id="pict-list" style="display:none;">
            <div class="text">
                <h2><span class="iconfont icon-hua-kuang-" style="font-size:25px;color:#1677FF;"></span>
                &emsp;图片列表
                </h2>
                <p>随机选取128张图片</p>
                <table>
                    <colgroup>
                        <col width="45%"/>
                        <col width="35%"/>
                        <col width="45%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>大小</th>
                            <th>修改日期</th>
                        </tr>
                    </thead>
                    <tbody id="pic-list">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
function showContent(id) {
    var contentSections = document.querySelectorAll('.content > div');
    for (var i = 0; i < contentSections.length; i++) {
        contentSections[i].style.display = 'none';
    }
    document.getElementById(id).style.display = 'block';
}

// 图片列表
const targetTableBody = document.querySelector('#pic-list');
            $(document).ready(function(){
                $.getJSON('/files/pic/pic-list.php', function(data){
                    var items = [];
                    $.each(data, function(key, val){
                        items.push("<tr><td>" + "<a href=/files/pic/pc/nt/source/" + val.name + ">" + val.name + "</a>" + "</td><td>" + val.size + " </td><td>" + val.modified_time + "</td></tr>");
                    });
                    $(targetTableBody).append(items.join(''));
                });
            });

// Linuxcat
console.log("");
</script>
</body>
</html>
