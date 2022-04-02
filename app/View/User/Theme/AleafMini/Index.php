<?php
require("Common/Header.php");
$commodityId = (int)$data["commodityId"] == 0 ? (int)$_GET['id'] : (int)$data["commodityId"];



if ($commodityId != 0) {
    require("Page/Commodity.php");
} else {
    require("Page/Index.php");
}

require("Common/Footer.php");