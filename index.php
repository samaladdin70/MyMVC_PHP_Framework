<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html; charset=utf-8');
// This is a simple and powerful Router App like frameworks
// first build your page as you want and need inside components directory .. like home.php or login.php or any you want
// i just biuld home.php, about.php and contact.php for example
// then make a new instance for Router Class
// then use get($route, $pathToFile); for get method
// or use post($route, $pathToFile); for post method
// then run();
// as like bellow

// note: any route doesn't installed as like bellow .. it will response and render a 404 not found page

use Router\Router;

include_once('./Router/Router.php');

$pages = new Router();
$pages->get('/', './components/home.php');
$pages->get('/about', './components/about.php');
$pages->get('/contact', './components/contact.php');
//$pages->get('/login', './components/login.php');
//$pages->post('/login', './components/login.php');
//$pages->get('/register', './components/register.php');
//$pages->post('/register', './components/register.php');
$pages->get('/register', './pages/register.php');
$pages->post('/register', './pages/register.php');
$pages->get('/login', './pages/login.php');
$pages->post('/login', './pages/login.php');
$pages->get('/sendmail', './agents/sendmail.php');
$pages->get('/confirmmail', './agents/confirmmail.php');




$pages->run();
/* echo '<div style="position:absolute; top:75px; left:20px; z-index:100;" class="p-4 d-flex justify-content-end"><pre class="bg-dark text-warning p-2 rounded">';
var_dump($pages->getRoute());
echo '</pre></div>'; */