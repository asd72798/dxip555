<?php
declare (strict_types=1);

return [
    [
        "title" => "style样式",
        "name" => "style1",
        "type" => "textarea",
        "placeholder" => "请输入style样式"
    ],
    [
        "title" => "JavaScript",
        "name" => "javascript1",
        "type" => "textarea",
        "placeholder" => "请输入js样式"
    ],
    [
        "title" => "说明",
        "name" => "explain1",
        "type" => "explain",
        "placeholder" => '<div style="color: red;">
        /*将店铺所有内容变为黑白色*/<br/>
        html{<br/>
            -webkit-filter:grayscale(100%);<br/>
            -moz-filter:grayscale(100%);<br/>
            -ms-filter:grayscale(100%);<br/>
            -o-filter:grayscale(100%);<br/>
            filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);<br/>
            _filter:none;<br/>
        }<br/>
        <br/>
        <br/>
        /*商品详情页图片样式隐藏*/<br/>
        .view-product{<br/>
            /*隐藏某个属性*/<br/>
            display: none;<br/>
        }<br/>
        /*头部选择器*/<br/>
        .header-middle {<br/>
            background: linear-gradient(to bottom right, #ffffffde, #d2ffeded);<br/>
        }<br/>
        /*腰部选择器*/<br/>
        .notice{<br/>
            background: rgba(255, 255, 255, 0.9);<br/>
        }<br/>
        /*商品分类选择器*/<br/>
        .category-products{<br/>
            background: rgba(255, 255, 255, 0.9);<br/>
        }<br/>
        /*商品选择器*/<br/>
        .product-image-wrapper{<br/>
            background: rgba(255, 255, 255, 0.9);<br/>
        }<br/>
        /*商品详情选择器*/<br/>
        .commodity-di{<br/>
            background: rgba(255, 255, 255, 0.9);<br/>
        }<br/>
        /*商品简介选择器*/<br/>
        .shop-details-tab{<br/>
            background: rgba(255, 255, 255, 0.9);<br/>
        }<br/>
        /*首页字体渐变start*/<br/>
        @keyframes move {<br/>
            0% {<br/>
                    background-position: 0 0;<br/>
                }<br/>
            100% {<br/>
                    background-position: -300px 0;<br/>
                }<br/>
               }<br/>
        .header-middle .logo a {<br/>
            background-image: linear-gradient(to right, red, orange, yellow, orange, red, orange, yellow, orange, red);<br/>
            -webkit-background-clip: text;<br/>
            animation: move 5s infinite;<br/>
            color: transparent;<br/>
            width: 300px;<br/>
            font-weight: bold;<br/>
            font-size: 24px;<br/>
        }<br/>
        /*首页字体渐变end*/
        </div>',
    ]
];