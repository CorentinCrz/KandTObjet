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

    /**
     * @throws \Exception
     */
    public function show()
    {
        if (isset($_GET['slug'])) {
            $data = $this->model->findBySlug($_GET['slug']);
        }
        if (isset($_GET['id'])) {
            $data = $this->model->findById($_GET['id']);
        }
        if (!isset($data)) {
            throw new \Exception("No id nor slug");
        }
        $this->view->show($data);
    }

    /**
     * @throws \Exception
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->view->add();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception("Haaaaan you shouldn't be here");
        }
        if(!isset($_POST['page'])){
            throw new \Exception("Gimme gimme gimme you data");
        }
        $data = $_POST['page'];
        $id = $this->model->addOne($data);
        header('Location: index.php?a=page.show&id='.$id);
    }

    /**
     *
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->deleteOne($this->view->checkIdPost());
            header('Location: /admin/');
            exit;
        }
        $id = $this->view->checkIdGet();
        $data = $this->model->findById($id);
        $this->view->delete($data, $id);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isset($_POST['page'])){
                throw new \Exception("Gimme gimme gimme you data");
            }
            $this->model->edit($_POST['page']);
            header('Location: /admin/');
            exit;
        }
        $id = $this->view->checkIdGet();
        $data = $this->model->findById($id);
        $this->view->edit($data);
    }

}