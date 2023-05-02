<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $sql = 'SELECT * FROM Products';
        $query = $this->modelsManager->createQuery($sql);
        $cars = $query->execute();
        $this->view->option="<option value=''>-Select-</option>";
        foreach ($cars as $value) {
            $this->view->option .= "<option value=".$value->name.">".$value->name."</option>";
        }
        $this->session->set('option', $this->view->option);
    }
}