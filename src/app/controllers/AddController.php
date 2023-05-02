<?php

use Phalcon\Mvc\Controller;

session_start();

class AddController extends Controller
{
    public function indexAction()
    {
        // Redirect to the View
    }
    public function roleAction()
    {
        // Redirect to the View
    }
    public function roleactAction()
    {
        if (!isset($_SESSION["roles"])) {
            $_SESSION["roles"] = array();
        }
        array_push($_SESSION["roles"], $_POST);
        print_r($_SESSION['roles']);
        $this->response->redirect('add/role');
    }
    public function contactionAction()
    {
        // Redirect to the View
    }
    public function contactAction()
    {
        if (!isset($_SESSION["contacts"])) {
            $_SESSION["contacts"] = array();
        }
        array_push($_SESSION["contacts"], $_POST);
        print_r($_SESSION['contacts']);
        $this->response->redirect('add/role');
    }
    public function allowAction()
    {
        // Redirect to the View
    }
    public function allactAction()
    {
        if (!isset($_SESSION["login"])) {
            $_SESSION["login"] = array();
        }
        array_push($_SESSION["login"], $_POST);
        $this->response->redirect('add/allow?val='.$_POST['roles']);
    }
}
