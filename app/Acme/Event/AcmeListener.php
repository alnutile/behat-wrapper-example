<?php namespace Acme\Event;

use BehatWrapper\Event\BehatEvent;
use BehatWrapper\Event\BehatEvents;
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

    public function behatPrepare(BehatEvent $event)
    {
        $event->getCommand()
            ->unsetFlag('no-paths')
            ->setOption('format', 'pretty');
        return $event;
    }

}