<?php
declare (strict_types=1);

return [
    [
        "title" => "说明",
        "name" => "explain",
        "type" => "explain",
        "placeholder" => "<b style='color: #0f8409;'>使用本插件之前，请安装PHP扩展：redis，如果你是宝塔用户，打开【php8管理->安装扩展->安装redis】，安装后再继续使用本插件。</b>",
    ],
    [
        "title" => "Host",
        "name" => "host",
        "type" => "input",
        "placeholder" => "Redis服务器地址",
        "default" => "127.0.0.1"
    ],
    [
        "title" => "端口",
        "name" => "port",
        "type" => "input",
        "placeholder" => "Redis服务器端口",
        "default" => 6379
    ],
    [
        "title" => "密码",
        "name" => "auth",
        "type" => "input",
        "placeholder" => "如果设置了密码请填写，没设置不要填写"
    ],
    [
        "title" => "缓存周期",
        "name" => "expire",
        "type" => "input",
        "placeholder" => "缓存周期，秒，推荐60秒",
        "default" => 60
    ]
];