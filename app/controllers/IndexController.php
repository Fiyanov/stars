<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 13:43
 */

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->persons = (new StarService())->getList();
    }

    public function personAction($id)
    {
        $this->view->person = (new StarService())->getPerson($id);
    }
}