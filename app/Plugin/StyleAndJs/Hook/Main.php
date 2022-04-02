<?php

declare(strict_types=1);

namespace App\Plugin\StyleAndJs\Hook;

use App\Controller\Base\View\UserPlugin;
use Kernel\Annotation\Hook;

class Main extends UserPlugin
{
    #[Hook(point: \App\Consts\Hook::USER_VIEW_INDEX_HEADER)]
    public function header()
    {
        $style1 = getPluginConfig('StyleAndJs')['style1'];
        $javascript1 = getPluginConfig('StyleAndJs')['javascript1'];
        echo $this->render("StyleAndJs", "style.html", ['style1' => $style1,'javascript1' => $javascript1]);
    }
}