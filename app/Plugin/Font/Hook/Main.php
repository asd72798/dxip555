<?php
declare (strict_types=1);

namespace App\Plugin\Font\Hook;

use App\Controller\Base\View\UserPlugin;
use App\Util\Plugin;
use Kernel\Annotation\Hook;
use Kernel\Exception\ViewException as ViewExceptionAlias;

class Main extends UserPlugin
{


    /**
     * @throws \ReflectionException
     * @throws ViewExceptionAlias
     */

    private function style(): void
    {
        $cfg = Plugin::getConfig("Font");
        echo $this->render(null, "Style.hook", ["cfg" => $cfg]);
    }

    /**
     * @throws \ReflectionException
     * @throws ViewExceptionAlias
     */
    #[Hook(point: \App\Consts\Hook::USER_VIEW_INDEX_HEADER)]
    public function index(): void
    {
        $this->style();
    }

    /**
     * @throws \ReflectionException
     * @throws ViewExceptionAlias
     */
    #[Hook(point: \App\Consts\Hook::ADMIN_VIEW_HEADER)]
    public function admin(): void
    {
        $this->style();
    }


    /**
     * @throws \ReflectionException
     * @throws ViewExceptionAlias
     */
    #[Hook(point: \App\Consts\Hook::USER_VIEW_HEADER)]
    public function user(): void
    {
        $this->style();
    }
}