<?php
declare(strict_types=1);

namespace App\Plugin\EmailWarning\Hook;

use App\Controller\Base\View\ManagePlugin;
use App\Model\Commodity;
use App\Model\Order;
use App\Model\Pay;
use App\Model\Card;
use App\Service\Email;
use Kernel\Annotation\Hook;
use Kernel\Annotation\Inject;
use App\Util\Plugin;
use App\Model\User;
use App\Entity\CreateObjectEntity;
use App\Entity\DeleteBatchEntity;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class Main extends ManagePlugin
{
    #[Inject]
    private Email $email;
     /**
     * 更新或安装时，安装数据库支持
     */
    private function InstallDB(): void
    {
        //判断字段是否存在，不存在则创建字段
        $textArray=array("warningNum");
        foreach ($textArray as $value){
            $extend = Manager::schema()->hasColumn("commodity", $value);
            if (!$extend) {
                Manager::schema()->table("commodity", function (Blueprint $blueprint) use ($value){
                    $blueprint->String($value)->nullable(true)->default(0);
                });
            }
        }
    }
   #[\Kernel\Annotation\Plugin(state: \Kernel\Annotation\Plugin::START)]
    public function State(): void
    {
        $this->InstallDB();
    }
    #[\Kernel\Annotation\Plugin(state: \Kernel\Annotation\Plugin::INSTALL)]
    public function Install(): void
    {
        $this->InstallDB();
    }

    #[\Kernel\Annotation\Plugin(state: \Kernel\Annotation\Plugin::UPGRADE)]
    public function Update(): void
    {
        $this->InstallDB();
    }
    
    #[Hook(point: \App\Consts\Hook::ADMIN_VIEW_COMMODITY_POST)]
    public function CommodityPost(): void
    {
        echo '{title: "库存预警量", name: "warningNum", type: "input",placeholder:"",tips: "当卡密库存不足设置的预警量时会发送邮件通知你，触发时机为用户购卡后", default: "10"},';
    }
    #[Hook(point: \App\Consts\Hook::USER_VIEW_COMMODITY_POST)]
    public function CommodityPost_user(): void
    {
        echo '{title: "库存预警量", name: "warningNum", type: "input",placeholder:"",tips: "当卡密库存不足设置的预警量时会发送邮件通知你，触发时机为用户购卡后", default: "10"},';
    }
    #[Hook(point: \App\Consts\Hook::USER_API_ORDER_PAY_AFTER)]
    public function pay(Commodity $commodity, Order $order, Pay $pay)
    {
        $Plugin_Name="EmailWarning";
        try {
            if ($commodity-> delivery_way == 0) {
                $count = Card::query()->where("commodity_id", (int)$commodity-> id)->where("status", 0);
                $race=$order->race;
                if ($race) {
                    $count = $count->where("race", $race);
                    $json['race']=$race;
                }
                $num=$count->count();
                
                $config = getPluginConfig($Plugin_Name);
                $yunum=(int)$commodity-> warningNum ;
                if($yunum==0){
                    $yunum=(int)$config['num'];
                }
                if ($num < $yunum) {
                    $str="【库存预警】".$commodity->name."的库存不足";
                    $str2="您的商品【".$commodity->name."】的库存还剩:".$num."<br> 低于预警量:".$yunum."<br> 请您尽快补卡！<br><br><br>          ————来自【库存预警】";
                   if($race){
                        $str="【库存预警】".$commodity->name."的".$race."种类的库存不足";
                        $str2="您的商品【".$commodity->name."】的【".$race."】种类库存还剩:".$num."<br> 低于预警量:".$yunum."<br>请您尽快补卡！<br><br><br>           ————来自【库存预警】";
                    }
                    //判断商品归属于谁
                    $user_id=$commodity->owner;
                    if((int)$user_id != 0){
                       $user= User::query()->where("id", (int)$user_id)->first();
                       if($user){
                            $email_str=$user->email;
                       }
                    }
                    //获取不到用户或id为0时发给默认邮箱
                    if($email_str == ''){
                        $email_str=$config['email'];
                    }
                    //发送邮件
                    $this->email->send($email_str,$str ,$str2);
                    Plugin::log($Plugin_Name,"用户id:".$user_id.",邮箱:".$email_str."  ".$commodity->name."的".$race."库存不足".$yunum);
                }
            }
        } catch (\Error | \Exception $e) {
        }
    }
}