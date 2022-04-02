<?php
declare(strict_types=1);

namespace App\View\User\Theme\Dream;

use App\Consts\Render;

/**
 * Interface Config
 * @package App\View\User\Theme\Cartoon
 */
interface Config
{
    /**
     * 介绍信息
     */
    const INFO = [
        "NAME" => "原初之梦",
        "AUTHOR" => "荔枝",
        "VERSION" => "1.0.1",
        "WEB_SITE" => "#",
        "DESCRIPTION" => "本模板在基础模板样式上做更改，采用分类和商品全预览方式展现，适合商品名称比较长的用户。",
        "RENDER" => Render::ENGINE_PHP
    ];

    /**
     * 配置信息
     */
    const SUBMIT = [
        [
            "title" => "缓存",
            "name" => "cache",
            "type" => "switch",
            "text" => "开启",
            "tips" => "浏览器本地缓存，缓存时间60秒"
        ],
        [
            "title" => "缓存时间",
            "name" => "cache_expire",
            "type" => "input",
            "placeholder" => "缓存过期时间，推荐60秒",
            "default" => 60
        ],
        [
            "title" => "ICP备案号",
            "name" => "icp",
            "type" => "input",
            "placeholder" => "填写后将会在店铺底部显示ICP备案号，不填写则不显示。"
        ],
    ];

    /**
     * 模板文件重定向，不需要修改的直接删除
     */
    const THEME = [
        "INDEX" => "Index/Index.php", //卡网首页
    ];

}