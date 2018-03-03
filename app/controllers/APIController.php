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
        return json_encode((new StarService())->getPerson($id));
    }

    public function getActorListAction()
    {
        $search = null;

        if ($this->request->isGet()) {
            $search = $this->request->get('term');
        }

        return json_encode((new StarService())->search($search));
    }
}