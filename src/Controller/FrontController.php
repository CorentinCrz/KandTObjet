<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:01
 */

namespace Controller;


class FrontController
{
    public function __construct()
    {
        $action = $_POST[\KANDT_ACTION_PARAM] ?? $_GET[\KANDT_ACTION_PARAM] ?? '';
        switch ($action) {
            case "page.show":
                // display page details
//                $controller = new PageController();
//                $controller->show();
                break;
            case "page.add":
                // display page ajout
//                $controller = new PageController();
//                $controller->add();
                break;
            case "page.edit":
                // display page edit
//                $controller = new PageController();
//                $controller->edit();
                break;
            case "page.delete":
                // display page delete
//                $controller = new PageController();
//                $controller->delete();
                break;
            case "page.index":
            default:
                // display page list
//                $controller = new PageController();
//                $controller->index();
                echo 'test index';
                break;
        }
    }
}