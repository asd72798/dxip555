<?php
declare (strict_types=1);

return [
    'STATUS' => '0',
    'style1' => '
@keyframes move {
0% {
background-position: 0 0;
}
100% {
background-position: -300px 0;
}
}
.header-middle .logo a {
background-image: linear-gradient(to right, red, orange, yellow, orange, red, orange, yellow, orange, red);
-webkit-background-clip: text;
animation: move 5s infinite;
color: transparent;
width: 300px;
font-weight: bold;
font-size: 24px;
}
',
    'javascript1' => '',
];