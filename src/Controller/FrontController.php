<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:01
 */

namespace Controller;


use View\PageView;

class FrontController
{
    public function __construct()
    {
        $view = new PageView();
        $view->adminHead();
        $controller = new PageController();
        $action = $_POST[\KANDT_ACTION_PARAM] ?? $_GET[\KANDT_ACTION_PARAM] ?? '';
        switch ($action) {
            case "page.show":
                // display page details
                $controller->show();
                break;
            case "page.add":
                // display page ajout
                $controller->add();
                break;
            case "page.edit":
                // display page edit
                $controller->edit();
                break;
            case "page.delete":
                // display page delete
                $controller->delete();
                break;
            case "page.index":
            default:
                // display page list
                $controller->index();
                break;
        }
        $view->adminFoot();
    }

}