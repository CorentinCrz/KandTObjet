<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:03
 */

namespace Controller;

use Model\PageModel;
use View\PageView;

/**
 * Class PageController
 * @package Controller
 */
class PageController
{
    /**
     * @var PageModel
     */
    private $model;
    /**
     * @var PageView
     */
    private $view;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->model = new PageModel();
        $this->view = new PageView();
    }

    /**
     *
     */
    public function index(): void
    {
        $data = $this->model->findAll();
        $this->view->index($data);
    }
}