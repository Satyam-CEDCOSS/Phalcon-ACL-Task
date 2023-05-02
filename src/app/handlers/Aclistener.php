<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;
use Phalcon\Events\Event;

session_start();

class Aclistener extends Injectable
{
    public function beforeHandleRequest(Event $events, Application $app, Dispatcher $dis)
    {
        if (isset($_SESSION['login'])) {
            $acl = new Memory();
            foreach ($_SESSION['login'] as $value) {
                $acl->addRole($value['roles']);
                $acl->addComponent(
                    $value['contollers'],
                    [
                        $value['actions']
                    ]
                );
                $acl->allow($value['roles'], $value['contollers'], $value['actions']);
            }
            $role = $_GET['val'];
            $controle = $dis->getControllerName();
            $action = $dis->getActionName();
            $check = $acl->isAllowed($role, $controle, $action);
            if (!$check) {
                echo "Access Denied";
                die;
            }
            // print_r($_SESSION['login']);
            // die;
        }
    }
}
