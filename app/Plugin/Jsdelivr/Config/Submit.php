<?php
declare (strict_types=1);

return [
    [
        "title" => "CDN节点",
        "name" => "cdn",
        "type" => "select",
        "placeholder" => "请选择",
        "dict" => [
            ["id" => "https://cdn.res.moecloud.cn/", "name" => "国内静态加速（idc.moe）"],
            ["id" => "-1", "name" => "自定义CDN"],
        ],
        "default" => "https://cdn.res.moecloud.cn/"
    ],
    [
        "title" => "自定义节点",
        "name" => "user_cdn",
        "type" => "input",
        "placeholder" => "有需要再填写，自定义CDN地址，根据程序目录自行上传资源。"
    ]
];