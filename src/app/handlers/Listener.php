<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;

class Listener extends Injectable
{
    public function beforeproduct()
    {
        $id = $this->getDI();
        $data = $id->get('session')->get('setting');
        if ($data['title']=="Tags"){
            $_POST['name'] = $_POST['name'] ." ". $_POST['tags'];
        }
        if ($_POST['stock'] == ""){
            $_POST['stock'] = $data['stock'];
        }
        if ($_POST['price'] == ""){
            $_POST['price'] = $data['price'];
        }
    }
    public function beforeorder(){
        $di = $this->getDI();
        $data = $di->get('session')->get('setting');
        if ($_POST['zipcode']==''){
            $_POST['zipcode'] = $data['zipcode'];
        }
    }
}