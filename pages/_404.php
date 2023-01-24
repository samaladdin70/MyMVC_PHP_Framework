<?php

use Controllers\Controller;

include_once('./Controllers/Controller.php');

$register = new Controller();
echo $register->pageInlayout('./components/_404.php', './layout/withoutNav.php');