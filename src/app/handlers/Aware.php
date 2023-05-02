<?php

namespace MyApp\Listener;

use Phalcon\Di\Injectable;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\ManagerInterface;

class Aware extends Injectable implements EventsAwareInterface
{
    protected $eventsManager;
    
    public function getEventsManager(): ManagerInterface
    {
        return $this->eventsManager;
    }

    public function setEventsManager(ManagerInterface $eventsManager): void
    {
        $this->eventsManager = $eventsManager;
    }


    public function process()
    {
        $this->eventsManager->fire('check:beforeproduct', $this);
        $this->eventsManager->fire('checks:beforeorder', $this);
    }
}