<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["config"]["title"]; ?></title>
    <meta name="keywords" content="<?php echo $data["config"]["keywords"]; ?>"/>
    <meta name="description" content="<?php echo $data["config"]["description"]; ?>"/>
    <link href="<?php echo $data['favicon']; ?>" rel="icon">

    <link rel="stylesheet" href="https://cdn.res.moecloud.cn/assets/static/font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.res.moecloud.cn/assets/static/css/i.css?v=<?php echo $data['app']['version']; ?>">
    <link href="<?php echo \App\Util\Helper::themeUrl('Assets/css/shop.css'); ?>" rel="stylesheet">
    <link href="<?php echo \App\Util\Helper::themeUrl('Assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo \App\Util\Helper::themeUrl('Assets/css/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo \App\Util\Helper::themeUrl('Assets/css/responsive.css'); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.res.moecloud.cn/assets/static/font/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.res.moecloud.cn/assets/static/jquery.min.js"></script>
    <script src="https://cdn.res.moecloud.cn/assets/static/acg.js?v=<?php echo $data['app']['version']; ?>"></script>
    <!--start::HOOK-->
    <?php hook(\App\Consts\Hook::USER_VIEW_INDEX_HEADER); ?>
    <!--end::HOOK-->
    <script>
        const cache_status = parseInt("<?php echo $data['setting']['cache'];?>");
        const cache_expire = parseInt("<?php echo $data['setting']['cache_expire'];?>");
    </script>
</head><!--/head-->

<body style="background: url('<?php echo $data['config']['background_url']; ?>')  fixed no-repeat;background-size: cover;">

<!--主页背景-->
<div style="background: rgba(255, 255, 255, 0);; /*overflow:auto;*/ height:100vh; -webkit-transform: translateZ(0); ">
    <header id="header">
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="/">
                                <img src="<?php echo $data['favicon']; ?>">
                                <?php echo $data['config']['shop_name']; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <?php if (!$data['user']) { ?>
                                <ul class="nav navbar-nav">
                                    <li><a href="/user/authentication/login?goto=/"><i class="fa fa-sign-in"></i> 登录</a>
                                    </li>
                                    <li><a href="/user/authentication/register?goto=/"><i class="fa fa-user-plus"></i>
                                            注册</a></li>
                                    <li><a href="/user/index/query"><i class="fa fa-safari"></i> 订单查询</a></li>
                                    <?php if ($data['config']['service_url']) { ?>
                                        <li>
                                            <a target="_blank" href="<?php echo $data['config']['service_url']; ?>"><i
                                                        class="fa fa-quora"></i> 联系客服</a>
                                        </li>
                                    <?php } ?>
                                </ul>

                            <?php } else { ?>

                                <span class="nickname">
                                        <span class="nicename">
                                            <a href="/user/dashboard/index">
                                            <img class="avatar"
                                                 src="<?php echo $data['user']['avatar'] ? $data['user']['avatar'] : '/favicon.ico'; ?>"
                                                 alt="avatar">
                                          <?php echo $data['user']['username']; ?></a>
                                            [<a style="color: #1da867;" href="/user/index/query">我的订单</a>]
                                             <?php if ($data['config']['service_url']) { ?>
                                                 [<a style="color: #f17599;" target="_blank"
                                                     href="<?php echo $data['config']['service_url']; ?>">客服</a>]
                                             <?php } ?>
                                        <a href="/user/authentication/logout"
                                           style="font-weight: ;font-size: 12px;margin-left: 2px;position:relative;top: -1px;color: #c49fa6;"><i
                                                    class="fa fa-sign-out"></i> 注销</a>
                                        </span><span class="balance">余额：￥<?php echo $data['user']['balance']; ?> <a
                                                href="/user/recharge/index"
                                                style="font-weight: normal;font-size: 12px;margin-left: 10px;position:relative;top: -1px;"><i
                                                    class="fa fa-paypal"></i> 充值</a></span>
                                    </span>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    </header>

