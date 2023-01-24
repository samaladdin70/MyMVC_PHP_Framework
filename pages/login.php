<?php

use Controllers\Controller;

include_once('./Controllers/Controller.php');

$register = new Controller();
echo $register->pageInlayout('./components/login.php', './layout/withoutNav.php');