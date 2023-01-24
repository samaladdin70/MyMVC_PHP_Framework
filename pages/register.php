<?php

use Controllers\Controller;

include_once('./Controllers/Controller.php');

$register = new Controller();
echo $register->pageInlayout('./components/register.php', './layout/withoutNav.php');

/* echo '<div style="position:absolute; top:75px; left:20px; z-index:100;" class="p-4 d-flex justify-content-end"><pre class="bg-dark text-warning p-2 rounded">';
var_dump($register->pageInlayout('./components/register.php', './layout/withoutNav.php'));
echo '</pre></div>'; */