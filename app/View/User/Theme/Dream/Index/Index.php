<?php require('Header.php'); ?>
    <div class="content-wrapper">
        <div class="container">

            <!--            公告部分-->
            <div class="card">
                <div class="card-header">
                    <p class="card-title"><i class="fa fa-bullhorn" aria-hidden="true"></i> 公告</p>
                </div>
                <div class="card-block">
                    <?php echo $data['config']['notice']; ?>
                </div>
            </div>

            <div class="category-list">
            </div>

        </div>
    </div>
    </div>


    <div class="open-commodity" style="display: none;">
        <div class="layout commodity-di">
            <div class="layout-content __html">
                <form class="commodity-form">
                    <p class="commodity_name"></p>
                    <p class="share_url"><i class="fa fa-share"></i> 将宝贝分享给好友</p>
                    <p class="description"></p>
                    <p class="seckill general">限时秒杀：<span class="seckill_timer"></span></p>
                    <p class="general">商品单价：<span class="price">0</span></p>
                    <p class="general">发货方式：<span class="delivery_way"></span></p>
                    <p class="general">联系方式：<input class="acg-input contact" type="text" name="contact"
                                                   placeholder="请输入联系方式">
                    </p>
                    <p class="password general">查询密码：<input class="acg-input" type="text" name="password"
                                                            placeholder="请设置查询密码">
                    </p>
                    <p class="widget general"></p>
                    <p class="coupon general">优惠代卷：<input class="acg-input" type="text" name="coupon"
                                                          placeholder="没有可不填写"
                                                          onchange="acg.API.tradeAmountPerform('.trade_amount')"></p>
                    <p class="general race-view">选择种类：<span></span></p>
                    <p class="general">购买数量：<input class="acg-input purchase_num" type="number" name="num" value="1"
                                                   onchange="acg.API.tradeAmountPerform('.trade_amount')"> <span
                                class="kucun">库存：<span class="card_count">0</span></span></p>
                    <p class="general captcha_status">人机验证：<input class="acg-input captcha-input" name="captcha"
                                                                  type="text"
                                                                  placeholder="请输入验证码"> <img
                                class="captcha"></p>
                    <p class="purchase_count general"></p>
                    <p class="general">订单金额：<span class="trade_amount">0</span></p>
                    <p class="general">售前客服：<a target="_blank" class="qq-service"><i class="fa fa-qq"></i> QQ客服</a><a
                                target="_blank"
                                class="web-service"><i
                                    class="fa fa-user-plus"></i> 网页客服</a></p>
                    <p class="lot"></p>
                    <p class="draft_status"></p>
                </form>
            </div>
        </div>
        <div class="layout pay-content">
            <label><i class="fa fa-shopping-cart"></i> 付款</label>
            <div class="pay_list">
            </div>
        </div>
    </div>

    <script>
        acg.ready("<?php echo $data['from'];?>", () => {
            let __html = $('.__html').html();
            let __htmlInit = () => {
                $('.commodity-di').show();
                $('.__html').html(__html);
            }
            let __htmlUnload = () => {
                $('.commodity-di').hide();
                $('.__html').html("");
            }

            __htmlUnload();

            let defaultCommodity = "<?php echo $data["commodityId"];?>";

            function inventoryHidden(state, count) {
                if (state == 0) {
                    return count;
                }
                if (count <= 0) {
                    return '已售罄';
                } else if (count <= 5) {
                    return '马上卖完';
                } else if (count <= 20) {
                    return '一般';
                } else if (count > 20) {
                    return '充足';
                }
            }

            let dom = {
                pageView() {
                    if (acg.Util.isPc()) {
                        let height = 760;
                        let pageHeight = $('.layui-layer-page[type=page]').height();
                        let top = ($(window).height() - height) / 2;
                        if (pageHeight > height) {
                            $('.layui-layer-page[type=page]').css("top", top + "px");
                            $('.layui-layer-content').css("height", height + "px");
                        } else {
                            let top2 = ($(window).height() - pageHeight) / 2;
                            $('.layui-layer-page[type=page]').css("top", top2 + "px");
                        }
                    }
                },
                initCategory() {
                    let self = this;

                    acg.API.category({
                        success: function (res) {

                            if (res.commodity_count > 0) {
                                $('.category-list').append(`<div class="card">
                    <div class="card-header">
                        <p class="card-title"><img class="commodity-icon" src="` + res.icon + `"> ` + res.name + `</p>
                    </div>
                    <div class="card-block">
                        <table class="layui-table">
                            <tbody class="category-` + res.id + `">
                            <tr class="head">
                                <th><i class="fa fa-ioxhost" aria-hidden="true"></i> 商品名称</th>
                                <th><i class="fa fa-buysellads" aria-hidden="true"></i> 单价</th>
                                <th><i class="fa fa-bolt" aria-hidden="true"></i> 库存</th>
                                <th></th>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>`);

                                let buyButton = function (item) {
                                    if (item.delivery_way == 0 && !item.shared && item.card_count <= 0) {
                                        return '<td>-</td>';
                                    }
                                    return `<td><a data-id="` + item.id + `" href="javascript:void (0);" class="commodity-click-` + res.id + `"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 购买</a></td>`;
                                }
                                //请求商品
                                acg.API.commoditys({
                                    keywords: "",
                                    categoryId: res.id,
                                    success: item => {
                                        $('.category-' + res.id).append(`<tr class="item">
                                <td><img class="commodity-icon" src="` + item.cover + `"> ` + item.name + `</td>
                                <td>￥` + (item.price) + `</td>
                                <td>` + (item.delivery_way == 0 && !item.shared ? inventoryHidden(item.inventory_hidden, item.card_count) : "未知") + `</td>
                                ` +  buyButton(item) + `
                            </tr>`);
                                    },
                                    empty: () => {

                                    },
                                    yes: () => {
                                        $('.commodity-click-' + res.id).click(function () {
                                            let commodityId = $(this).attr("data-id");
                                            dom.commodity(commodityId);
                                        });

                                        if (defaultCommodity && defaultCommodity != 0) {
                                            $('.commodity-click-' + res.id + '[data-id=' + defaultCommodity + ']').trigger("click");
                                            defaultCommodity = null;
                                        }
                                    }
                                });
                            }


                        }
                    });

                },
                commodity(commodityId) {
                    acg.API.commodity({
                        commodityId: commodityId,
                        pay: ".pay-content",
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
                            widget: '.widget',
                        },
                        begin: () => {
                            __htmlInit();
                        },
                        success: res => {
                            $('.qq-service').attr("href", 'https://wpa.qq.com/msgrd?v=1&uin=' + res.service_qq);
                            $('.web-service').attr("href", res.service_url);
                            //layer
                            layer.open({
                                type: 1,
                                shade: [0.3, "#fff"],
                                title: acg.Util.isPc() ? false : res.name,
                                content: $('.open-commodity'),
                                area: acg.Util.isPc() ? "620px" : ["100%", "100%"],
                                success: () => {
                                    dom.pageView();
                                    setTimeout(() => {
                                        dom.pageView();
                                    }, 200);
                                }
                            });
                        }
                    });
                }

            }
            dom.initCategory();

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
        });
    </script>
<?php require('Footer.php'); ?>