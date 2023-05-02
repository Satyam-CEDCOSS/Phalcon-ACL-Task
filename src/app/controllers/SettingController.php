<?php

use Phalcon\Mvc\Controller;


class SettingController extends Controller
{
    public function indexAction()
    {
        // Redirect to View
    }

    public function addAction()
    {
        $this->session->set('setting', $_POST);
        $this->response->redirect('setting');
    }
}