<?php

use Phalcon\Mvc\Controller;
use MyApp\Listener\Listener;
use MyApp\Listener\Aware;
use Phalcon\Events\Manager as EventsManager;

class ProductController extends Controller
{
    public function indexAction()
    {
        $sql = 'SELECT * FROM Products';
        $query = $this->modelsManager->createQuery($sql);
        $cars = $query->execute();
        $this->view->display="";
        foreach ($cars as $value) {
            $this->view->display .= "<tr>
            <td>".$value->name."</td><td>".$value->description."</td>
            <td>".$value->tags."</td><td>".$value->price."</td>
            <td>".$value->stock."</td></tr>";
        }
    }
    public function listAction()
    {
        // Redirect to View
    }
    public function addAction()
    {
        $eventsManager = new EventsManager();
        $connection = new Aware();
        $connection->setEventsManager($eventsManager);
        $eventsManager->attach(
            'check',
            new Listener()
        );
        $connection->process();
        $product = new Products();

        $product->assign(
            $this->request->getPost(),
            [
                'name',
                'description',
                'tags',
                'price',
                'stock'
            ]
        );
        $success = $product->save();
        $this->view->success = $success;
        if ($success) {
            $this->view->message = "Data Added";
        }
        else{
            $this->view->message = "Not Added";
        }
    }
}
