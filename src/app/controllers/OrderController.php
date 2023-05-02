<?php

use Phalcon\Mvc\Controller;
use MyApp\Listener\Listener;
use MyApp\Listener\Aware;
use Phalcon\Events\Manager as EventsManager;

class OrderController extends Controller
{
    public function indexAction()
    {
        $sql = 'SELECT * FROM Orders';
        $query = $this->modelsManager->createQuery($sql);
        $cars = $query->execute();
        $this->view->display = "";
        foreach ($cars as $value) {
            $this->view->display .= "<tr>
            <td>".$value->name."</td><td>".$value->address."</td>
            <td>".$value->zipcode."</td><td>".$value->product."</td>
            <td>".$value->quantity."</td></tr>";
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
            'checks',
            new Listener()
        );
        $connection->process();

        $order = new Orders();

        $order->assign(
            $this->request->getPost(),
            [
                'name',
                'address',
                'zipcode',
                'product',
                'quantity'
            ]
        );
        $success = $order->save();
        $this->view->success = $success;
        if ($success) {
            $this->view->message = "Data Added";
        } else {
            $this->view->message = "Not Added";
        }
    }
}
