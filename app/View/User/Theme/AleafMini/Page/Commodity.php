<?php 
function isMobile() { 
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return true;
  } 
  // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
  if (isset($_SERVER['HTTP_VIA'])) { 
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  } 
  // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger'); 
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return true;
    } 
  } 
  // 协议法，因为有可能不准确，放到最后判断
  if (isset ($_SERVER['HTTP_ACCEPT'])) { 
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'textml') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'textml')))) {
      return true;
    } 
  } 
  return false;
}
?>
<div class="container loading" style="padding-left: 35px;padding-right: 35px;">
    <div class="row">
        <div class="col-sm-12 notice" style="color: #25abcd;padding-bottom: 20px;">
            (⁎˃ᆺ˂) 正在加载，请稍等..
        </div>
    </div>
</div>

<section class="commodity-html" style="margin-top: 0px;display: none;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <!--isMobile()返回结果非pc-->
                        <div class="view-product" <?php if(isMobile()){echo '
                        /*隐藏元素*/
                        style="
                        /*display: none;*/
                        "';} ?>>
                            <img class="cover" src="" alt=""/>
                            <h3 class="commodity_name"></h3>
                        </div>
                    </div>
                   <div class="col-sm-7">
                        <div class="open-commodity">
                            <!--/product-information-->
                            <form class="commodity-form commodity-di">
                                <p class="commodity_name"></p>
                                <p class="share_url"><i class="fa fa-share"></i> 将宝贝分享给好友</p>
                                <p class="seckill general">限时秒杀：<span class="seckill_timer"></span></p>
                                <p class="general">商品单价：<span class="price">0</span></p>
                                <p class="general">发货方式：<span class="delivery_way"></span></p>
                                <p class="general">联系方式：<input class="acg-input contact" type="text" name="contact"
                                                               placeholder="请输入联系方式">
                                </p>
                                <p class="password general">查询密码：<input class="acg-input" type="text" name="password"
                                                                        placeholder="请设置查询密码">
                                </p>
                                <p class="widget_g general"></p>
                                <p class="coupon general">优惠代卷：<input class="acg-input" type="text" name="coupon"
                                                                      placeholder="没有可不填写"
                                                                      onchange="acg.API.tradeAmountPerform('.trade_amount')">
                                </p>
                                <p class="general race-view">选择种类：<span></span></p>
                                <p class="general">购买数量：<input class="acg-input purchase_num" type="number" name="num"
                                                               value="1"
                                                               onchange="acg.API.tradeAmountPerform('.trade_amount')">
                                    <span
                                            class="com_kucun">库存：<span class="card_count">0</span></span></p>
                                <p class="general captcha_status">人机验证：<input class="acg-input captcha-input"
                                                                              name="captcha" type="text"
                                                                              placeholder="请输入验证码"> <img
                                            class="captcha"></p>
                                <p class="purchase_count general"></p>
                                <p class="general">订单金额：<span class="trade_amount">0</span></p>
                                <p class="general">售前客服：<a target="_blank" class="qq-service"><i class="fa fa-qq"></i>
                                        QQ客服</a><a
                                            target="_blank"
                                            class="web-service"><i class="fa fa-user-plus"></i> 网页客服</a></p>
                                <p class="lot general"></p>
                                <p class="draft_status general"></p>
                                <div class="pay-content">
                                    <p class=" pay_title"><span><i class="fa fa-shopping-cart"></i> 结账</span></p>
                                    <p class="general pay_list"></p>
                                </div>
                            </form>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <div class="col-sm-12 description-title">
                        <i class="fa fa-book"></i> 商品介绍
                    </div>
                    <div class="tab-content">
                        <div>
                            <div class="col-sm-12">
                                <p class="description">
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!--/category-tab-->
            </div>
        </div>
    </div>
</section>

<script>
    try {
        acg.ready("<?php echo $data['from'];?>", () => {
            //初始化支付
            acg.API.pay({
                success: item => {
                    if (item.handle === "#system") {
                        <?php if ($data['user']){?>
                        $('.pay_list').append(' <a class="pay-button" onclick="acg.API.tradePerform(' + item.id + ')" style="line-height: 22px;color: #ffffff;background:#e5b9b9b0;"> <img src="' + item.icon + '"> ' + item.name + '(<?php echo sprintf("%.2f", $data['user']['balance'])?>)</a>');
                        <?php }?>
                    } else {
                        $('.pay_list').append(' <a class="pay-button" onclick="acg.API.tradePerform(' + item.id + ')" style="line-height: 22px;"><img src="' + item.icon + '"> ' + item.name + '</a>');
                    }
                }
            });

            acg.API.commodity({
                commodityId: <?php echo $commodityId;?>,
                auto: {
                    race: '.race-view',
                    name: '.commodity_name',
                    share_url: '.share_url',
                    description: '.description',
                    delivery_way: '.delivery_way',
                    contact_type: '.contact',
                    coupon: '.coupon',
                    purchase_num: '.purchase_num',
                    captcha: '.captcha',
                    password_status: '.password',
                    lot_status: '.lot',
                    seckill_status: '.seckill',
                    card: '.card_count',
                    purchase_count: '.purchase_count',
                    price: '.price',
                    trade_amount: '.trade_amount',
                    draft_status: '.draft_status',
                    widget: '.widget_g',
                },
                success: res => {
                    $('.qq-service').attr("href", 'https://wpa.qq.com/msgrd?v=1&uin=' + res.service_qq);
                    $('.web-service').attr("href", res.service_url);
                    $('.cover').attr("src", res.cover);
                    $('.loading').hide();
                    $('.commodity-html').show();
                    if (!res.login) {
                        if (res.only_user == 1 || res.purchase_count > 0) {
                            $(".pay_list").removeClass("pay_list").html('<div class="need-login">该商品需要登录才能购买，<a href="/user/authentication/login?goto=' + res.share_url + '">现在登录</a></div>');
                        }
                    }
                }
            });

        });
    } catch (e) {
    }
</script>