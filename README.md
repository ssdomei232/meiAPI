# meiAPI
这里存放着 meiAPI 过去版本的屎山代码以及一些废弃的打标脚本

## 旧版API
此 API 代码为近一年的屎山累积,难以理解,欢迎各位品鉴     
我写一些我还记得的使用说明:     
`files/img/`存放着所有图片,我删除了一些东西,之前这里有一堆乱七八糟的没用的api       
```
└─pic
    ├─fox
    |  └─这里存放着狐狸图,是既不区分时间也不区分终端类型图片的代表
    ├─phone
    │  ├─nt
    │  │  ├─webp
    │  │  │  └─不区分时间的竖屏图像的压缩图
    │  │  └─source
    │  │     └─不区分时间的竖屏图像的原图
    │  └─yt
    │     ├─webp
    │     │  ├─dark
    │     │  │  └─区分时间的竖屏图像的压缩图(黑暗主题)
    │     │  └─light
    │     │     └─区分时间的竖屏图像的压缩图(明亮主题)
    │     └─source
    │         ├─dark
    │         │  └─区分时间的竖屏图像的压缩图(黑暗主题)
    │         └─light
    │            └─区分时间的竖屏图像的压缩图(明亮主题)
    └─pc
        ├─nt
        │  ├─webp
        |  |  └─不区分时间的横屏图像的压缩图
        │  └─source
        │     └─不区分时间的横屏图像的原图
        └─yt
            ├─webp
            │  ├─dark
            │  │  └─区分时间的横屏图像的压缩图(黑暗主题)
            │  └─light
            │     └─区分时间的横屏图像的压缩图(明亮主题)
            └─source
                ├─dark
                │  └─区分时间的横屏图像的压缩图(黑暗主题)
                └─light
                    └─区分时间的横屏图像的压缩图(明亮主题)
```
可以看到,在这坨屎山中,为了不使用数据库,每张图都得存两次,而且还有着令人头大的目录结构
```
├─apis
│  └─屎山区
|
├─assets
│  ├─css
│  └─js
├─pic
│  └─图片API逻辑区
|
└─safe
   └─AI写的参数清理,我也不知道有啥意义
```
## 打标脚本
打标脚本不是和旧版 API 配套的,是在开发新版 API 时的废案     
废弃的原因是因为此版本的打标脚本过于复杂,过于耗费时间,并且功能也不一定有啥用,如果你很闲,可以尝逝用一用      
`catch/` : 存放待打标的图片     
`img/` : 打完标重命名完的图片和相应的压缩后的图片
