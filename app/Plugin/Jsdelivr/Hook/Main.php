<?php
declare(strict_types=1);

namespace App\Plugin\Jsdelivr\Hook;

use App\Util\Plugin;
use Kernel\Annotation\Hook;
use Kernel\Exception\JSONException;


/**
 *
 */
class Main
{
    #[Hook(point: \App\Consts\Hook::HTTP_ROUTE_RESPONSE)]
    public function routeAccess(string $route, mixed $response): void
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "get" && is_string($response)) {
            //判定是否HTML网页
            if (preg_match("#<head>[\s\S]+?</head>#", $response)) {
                $config = Plugin::getConfig("Jsdelivr");
                $cdn = $config['cdn'];

                if ($cdn == "-1") {
                    $cdn = $config['user_cdn'];
                }
                
                //替换网页
                header("Content-type: text/html; charset=utf-8");
                $response = str_replace('<script src="/', '<script src="' . $cdn, $response);
                $response = str_replace('<link rel="stylesheet" href="/', '<link rel="stylesheet" href="' . $cdn, $response);
                $response = preg_replace('#<link href="/([\s\S]+?)" rel="stylesheet"#', '<link href="' . $cdn . '${1}" rel="stylesheet"', $response);
                echo $response;
                exit;
            }
        }
    }
}