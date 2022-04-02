<?php
declare (strict_types=1);

return [
    [
        "title" => "说明",
        "name" => "explain",
        "type" => "explain",
        "placeholder" => "<b style='color: #0f8409;'>使用本插件之前，请先添加QQ：1152824670 为好友，并且给他发个消息：你好。他并不会回复你，但这就足够了。</b><br><br><b style='color: red'>值得注意的是，该QQ并不会记录和您之间的消息，每次发送消息后自动会清理聊天记录，请完全放心使用。</b>",
    ],
    [
        "title" => "QQ号",
        "name" => "qq",
        "type" => "input",
        "placeholder" => "接受通知的QQ号"
    ],
    [
        "title" => "下单话术",
        "name" => "trade_content",
        "type" => "textarea",
        "placeholder" => "请输入下单后发给你QQ的话术",
        "default" => "【订单创建成功】
商品名称：[commodity.name] * [order.card_num]
订单号：[order.trade_no]
下单时间：[order.create_time]
IP地址：[order.create_ip]
联系方式：[order.contact]
支付方式：[pay.name]"
    ],
    [
        "title" => "下单通知",
        "name" => "trade",
        "type" => "switch",
        "text" => "启用"
    ],
    [
        "title" => "付款话术",
        "name" => "payment_content",
        "type" => "textarea",
        "placeholder" => "请输入付款后发给你QQ的话术",
        "default" => "【订单交易成功】
商品名称：[commodity.name] * [order.card_num]
订单号：[order.trade_no]
支付时间：[order.pay_time]
支付方式：[pay.name]"
    ],
    [
        "title" => "付款通知",
        "name" => "payment",
        "type" => "switch",
        "text" => "启用"
    ]
];