<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 13:43
 */

use Phalcon\Mvc\Controller;

class APIController extends Controller
{
    public function indexAction()
    {
        return $this->getActorListAction();
    }

    public function getActorAction($id)
    {
        return $id;
    }

    public function getActorListAction()
    {
        return [];
    }
}