<?php
declare(strict_types=1);

namespace App\Plugin\wxqq\Hook;


use App\Controller\Base\View\UserPlugin;
use App\Util\Plugin;
use App\Util\Str;
use Kernel\Annotation\Hook;
use App\Util\Client;

$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';

class Main extends UserPlugin
{
    /**
     * @throws \Kernel\Exception\ViewException
     * 核心初始化之前
     */
    #[Hook(point: \App\Consts\Hook::KERNEL_INIT)]
    public function intercept(): void
    {
        /*
        //反拦截扫描
        $route = trim((string)$_GET['s'], "/");
        if (in_array($route, self::ROUTE) && $_SESSION[self::ANTI_KIDNAP_SESSION] != 1) {
            $token = Str::generateRandStr(32);
            $_SESSION[self::ANTI_KIDNAP_TOKEN] = $token;
            echo $this->render("anti", "anti.html", ['token' => $token]);
            exit;
        }*/
        $ImgUrl= getPluginConfig('Wxqq')['ImgUrl'];
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !==false){
            $GetUrl='http://'.$_SERVER['SERVER_NAME'].''.$_SERVER["REQUEST_URI"];
            /*
            反腾讯网址安全检测系统
            Description:屏蔽腾讯电脑管家网址安全检测
            Version:2.5
            Author:消失的彩虹海
            */
            if($nosecu==true)return;
            //HEADER 特征屏蔽
            if(preg_match("/manager/", strtolower($_SERVER['HTTP_USER_AGENT'])) || preg_match("/QZONEJSSDK/", $_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla')===false && strpos($_SERVER['HTTP_USER_AGENT'], 'ozilla')!==false || preg_match("/Windows NT 6.1/", $_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_ACCEPT']=='*/*' || preg_match("/Windows NT 5.1/", $_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_ACCEPT']=='*/*' || preg_match("nd.wap.wml/", $_SERVER['HTTP_ACCEPT']) && preg_match("/Windows NT 5.1/", $_SERVER['HTTP_USER_AGENT']) || isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'urls.tr.com')!==false || isset($_COOKIE['ASPSESSIONIDQASBQDRC']) || empty($_SERVER['HTTP_USER_AGENT']) || preg_match("/Alibaba.Security.Heimdall/", $_SERVER['HTTP_USER_AGENT'])) {
                exit('欢迎使用！');
            }
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone OS 9_3_4')!==false && $_SERVER['HTTP_ACCEPT']=='*/*' || strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone OS 8_4')!==false && $_SERVER['HTTP_ACCEPT']=='*/*' || strpos($_SERVER['HTTP_USER_AGENT'], 'Android 6.0.1')!==false && strpos($_SERVER['HTTP_USER_AGENT'], 'MQQBrowser/6.8')!==false) {
                exit('您当前浏览器不支持或操作系统语言设置非中文，无法访问本站！');
                }
            //$ImgUrl= getPluginConfig('Wxqq')['ImgUrl'];
            echo $this->render("ImgUrl", "error.html", ['ImgUrl' => $ImgUrl,'GetUrl' => $GetUrl]);
            exit;
        }
    }
}