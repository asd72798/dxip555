<?php
declare(strict_types=1);

namespace App\Interceptor;


use App\Util\Client;
use JetBrains\PhpStorm\NoReturn;
use Kernel\Annotation\InterceptorInterface;
use Kernel\Exception\JSONException;
use Kernel\Util\View;

class Waf implements InterceptorInterface
{
    #[NoReturn] public function handle(int $type): void
    {
        if (!file_exists(BASE_PATH . '/kernel/Install/Lock')) {
            echo View::render("Rewrite.html");
            exit;
        }

        \App\Util\Waf::instance()->run(/**
         * @throws \Kernel\Exception\JSONException
         */ function (string $message) {
            throw new JSONException("非法请求");
        });
    }
}