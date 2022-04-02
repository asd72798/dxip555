<?php
declare(strict_types=1);

namespace App\View\User\Theme\AleafMini;

use App\Consts\Render;

interface Config
{
    const INFO = [
        "NAME" => "落叶之梦",
        "AUTHOR" => "可乐和鱼",
        "VERSION" => "1.0.7",
        "WEB_SITE" => "http://lizhi.yubro.cn/",
        "DESCRIPTION" => "原初之梦的主页加上梦之落叶的商品详情单页，可乐和鱼儿心诚之作！",
        //"RENDER" => Render::ENGINE_SMARTY
        "RENDER" => Render::ENGINE_PHP
    ];

    /**
     * 配置信息
     */
    const SUBMIT = [
        [
            "title" => "ICP备案号",
            "name" => "icp",
            "type" => "input",
            "placeholder" => "填写后将会在店铺底部显示ICP备案号，不填写则不显示。"
        ],
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
        "title" => "说明",
        "name" => "explain1",
        "type" => "explain",
        "placeholder" => '<b style="color: green;">感谢老板使用本插件！</br>老板牛逼！ 老板有排面，老板硬邦邦 ！</br>老板妻妾成群，后宫佳丽三千！</br>老板一节更比六节强！节节续航像太阳！</br>老板洪福齐天寿与天齐，千秋万代一统江湖！</br>老板一个头两个大，两个头一样大!</br>感谢老板，谢谢老板！ </br>老板夜夜当新郎，老板夜夜抱新娘，全国都有丈母娘！</br>Ps：本项目是一个开源程序，购买即可看到源代码并且可以随便修改！</b>',
        ]
    ];

    /**
     * 主题配置
     */
    const THEME = [
        "INDEX" => "Index.php",//首页
        "QUERY" => "Query.php",//订单
        "LOGIN" => "Authentication/Login.html", //用户登录
        "REGISTER" => "Authentication/Register.html", //用户注册
    ];
}