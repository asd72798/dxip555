<?php require("Common/Header.php"); ?>

<!--主页背景-->
<div style="background: rgba(255, 255, 255, 0);; /*overflow:auto;*/ height:100vh; -webkit-transform: translateZ(0); ">
    <div class="container" style="padding-left: 35px;padding-right: 35px;">

        <div class="row order-query">
            <h2>查询订单</h2>
            <div class="col-sm-12 widget-input">
                <input type="text" class="form-control keywords" placeholder="请输入联系方式或订单号进行查询"
                       autocomplete="off"
                       value="<?php echo $data['tradeNo']; ?>">
                <button class="btn btn-primary queryBtn">查询</button>
            </div>
        </div>
    </div>


    <div class="container order-view" style="padding-left: 35px;padding-right: 35px;margin-bottom: 50px;display: none">
        <div class="row order-query">
            <h2 style="margin-bottom: 5px;">查询结果</h2>
            <div class="order-success"></div>
        </div>
    </div>


    <script>
        try {
            acg.ready("<?php echo $data['from'];?>", () => {
                //订单查询
                let instance = $('.keywords');

                function query(keywords) {
                    $('.order-view').hide();
                    let orderSuccess = $('.order-success');
                    orderSuccess.html('');
                    acg.API.query({
                        keywords: keywords,
                        success: order => {
                            if (order.commodity && order.pay) {
                                let status = '<span style="color: red;">未支付</span>';
                                if (order.status === 1) {
                                    status = '<span style="color: green;">已支付</span>';
                                }

                                let race = "";
                                if (order.race) {
                                    race = " ( <b style='color: #20b033;'>" + order.race + "</b> )";
                                }

                                let html = '<div class="hr-top">\n' +
                                    '                        <div style="font-size: 14px;">订单号：<span class="trade_no">' + order.trade_no + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">下单金额：<span style="color: red;" class="amount">￥' + order.amount + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">购买数量：<span style="color: #3f8f7f;" class="buyNum">' + order.card_num + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">下单时间：<span class="create_time">' + order.create_time + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">商品名称：<span>' + order.commodity.name + race + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">支付方式：<span class="icon"><img src="' + order.pay.icon + '" style="height: 16px;" ">' + order.pay.name + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;">订单状态：<span class="status">' + status + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;' + (order.status == 1 ? '' : 'display: none;') + '" class="payDateView">支付时间：<span class="pay_date"\n' +
                                    '                                                                                                style="color: green;">' + order.pay_time + '</span>\n' +
                                    '                        </div>\n' +
                                    '                        <div style="font-size: 14px;">售后支持：<span style="color: #d78aeb;font-weight: bold;"><img src="' + order.business_avatar + '" style="height: 18px;border-radius: 100%;"> ' + order.business_username + '</span> [<a target="_blank" href="https://wpa.qq.com/msgrd?v=1&uin=' + order.service_qq + '" style="color: #2aa2e3;padding:0 4px 0 4px;font-size: 12px;margin:0 4px 0 0;border-radius: 5px;" class="button-click"><i class="fa fa-qq"></i> QQ客服</a><a target="_blank" href="' + order.service_url + '" class="button-click" style="color: #ff8484;padding:0 4px 0 4px;margin:0;font-size: 12px;border-radius: 5px;"><i class="fa fa-user-plus"></i> 网页客服</a>]</div>\n' +
                                    '                        <div style="font-size: 14px;' + (order.leave_message ? "" : " display: none;") + '">使用说明：<span>' + order.leave_message + '</span></div>\n' +
                                    '                        <div style="font-size: 14px;margin: 5px 0 5px 0;">卡密信息：<input style="' + (order.commodity.password_status == 1 ? '<?php echo $data['user'] ? 'display:none;' : '';?>' : 'display:none;') + '"  type="text" placeholder="请输入查询密码.." class="query-password passId-' + order.id + '"> <span style="cursor:pointer;" class="getCard" data-id="' + order.id + '">查看</span></div>\n' +
                                    '                        <div style="margin-top: 10px; display: none;" class="cardInfoView-' + order.id + '">\n' +
                                    '                            <textarea class="form-control card-textarea cardInfo-' + order.id + '" style="height: 420px;"></textarea>\n' +
                                    '                        </div>\n' +
                                    '                    </div>';
                                orderSuccess.append(html);
                            }
                        },
                        yes: res => {
                            $('.order-view').show();
                            $('.getCard').click(function () {
                                let orderId = $(this).attr('data-id');
                                acg.API.secret({
                                    orderId: orderId,
                                    password: $('.passId-' + orderId).val(),
                                    success: res => {
                                        let secret = "";
                                        if (res.widget) {
                                            secret += "--------------您隐私内容---------------\n";
                                            for (const widgetKey in res.widget) {
                                                secret += res.widget[widgetKey].cn + "：" + res.widget[widgetKey].value + "\n";
                                            }
                                            secret += "--------------卡密信息---------------\n";
                                        }
                                        secret += res.secret;
                                        $('.cardInfo-' + orderId).html(secret);
                                        $('.cardInfoView-' + orderId).show(80);
                                    }
                                });
                            });
                        },
                        error: () => {
                        }
                    });
                }

                $('.queryBtn').click(function () {
                    query(instance.val());
                });

                <?php if ($data['tradeNo'] != "" || $data['user']) {?>
                $('.queryBtn').click();
                <?php }?>


                instance.keyup(function (event) {
                    if (event.keyCode == 13) {
                        $('.queryBtn').click();
                    }
                });
            });
        } catch (e) {

        }
    </script>

</div>
<?php require("Common/Footer.php"); ?>