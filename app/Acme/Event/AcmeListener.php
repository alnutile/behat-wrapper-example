<?php namespace Acme\Event;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class AcmeListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'behat.command.prepare'     => array('behatPrepare', 0),
        );
    }

    public function behatPrepare(FilterOrderEvent $event)
    {
        dd('Yup');
    }
}