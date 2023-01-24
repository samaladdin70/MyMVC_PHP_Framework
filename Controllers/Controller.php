<?php

namespace Controllers;

class Controller
{
    /**
     * [Description for pageInlayout]
     *
     * @param String path to page $page
     * @param String path to layout $layOute
     * 
     * @return mixed
     * 
     * Created at: 9/23/2022, 1:31:34 AM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function pageInlayout($page, $layOute)
    {
        return str_replace('(())', $this->pageToVariable($page), $this->pageToVariable($layOute));
    }



    /**
     * [Description for pageToVariable]
     *
     * @param String Path to page $page
     * 
     * @return String page content
     * 
     * Created at: 9/23/2022, 1:27:57 AM (Egypt/Cairo)
     * @author     Aladdin 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin 
     */
    function pageToVariable($page)
    {
        ob_start();
        include_once($page);
        return ob_get_clean();
    }
}