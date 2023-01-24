<?php

// use phpDocumentor\Reflection\Location;
namespace Router;

use GlobalEnv;

include_once('./GlobalEnv.php');

/**
 * [Description Router]
 * class for MVC Routing System
 */
class Router
{
    public $routes = [];
    public $params = [];

    function get($route, $target, $params = [])
    {
        $this->routes['get'][$route] = $target;
        $this->params['get'][$route] = $params;
    }

    function post($route, $target, $params = [])
    {
        $this->routes['post'][$route] = $target;
        $this->params['post'][$route] = $params;
    }

    /**
     * [Description for method]
     *
     * @return String REQUEST_METHOD POST or GET in lowercase
     * 
     * Created at: 9/22/2022, 9:39:37 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    /**
     * [Description for getRoute]
     *
     * @return String path route without servername like /login
     * without ?
     * 
     * Created at: 9/22/2022, 9:41:17 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function getRoute()
    {
        $path = $_SERVER['REQUEST_URI'];
        $QtPosition = strpos($path, '?');
        if ($QtPosition === false) {
            return $path;
        } else {
            return $path = substr($path, 0, $QtPosition);
        }
    }

    static function getRouteStatic()
    {
        $path = $_SERVER['REQUEST_URI'];
        $QtPosition = strpos($path, '?');
        if ($QtPosition === false) {
            return $path;
        } else {
            return $path = substr($path, 0, $QtPosition);
        }
    }
    static function methodStatic()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    /**
     * [Description for pageRender]
     *
     * @return String pages with default layout
     * or custom invidual page with own layout must be in directory ./pages
     * 
     * Created at: 9/22/2022, 9:43:06 PM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function pageRender()
    {
        $path = $this->getRoute();
        $method = $this->method();
        if (isset($this->routes[$method][$path])) {
            $findPage = $this->routes[$method][$path];
            ob_start();
            include_once($findPage);
            $page =  ob_get_clean();
            if (strpos($findPage, '/pages') !== false) {
                return $page;
            } else {
                $layOut = $this->layOutRender();
                return str_replace('(())', $page, $layOut);
            }
        } else {
            http_response_code(404);
            ob_start();
            include_once("./components/_404.php");
            $page =  ob_get_clean();
            $layOut = $this->layOutRender();
            //$pathArray = explode('/', $path);
            // $arrayElement = count($pathArray);
            return str_replace('(())', $page, $layOut);
        }
    }

    /**
     * [Description for layOutRender]
     *
     * @param  String path to layout $layout
     * 
     * @return String Main Layout content for Wbsite
     * 
     * Created at: 9/23/2022, 1:11:33 AM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function layOutRender($layout = GlobalEnv::MAIN_LAYOUT)
    {
        ob_start();
        include_once($layout);
        return ob_get_clean();
    }

    function run()
    {
        echo $this->pageRender();
    }
}