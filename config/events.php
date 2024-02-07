<?php declare(strict_types=1);

use App\Application\Event\EventDispatcher;
use App\Application\Event\EventDispatcherInterface;
use App\Application\Event\EventInterface;

$events = require_once 'autoload/events.php';

$GLOBALS['event_dispatcher'] =
$eventDispatcher = new EventDispatcher();

{
    foreach ($events as $event => $handlers) {
        foreach ($handlers as $handler) {
            $eventDispatcher->register($event, new $handler);
        }
    }
}

if (! function_exists('get_event_dispatcher')) {
    /**
     * @return EventDispatcherInterface
     */
    function get_event_dispatcher(): EventDispatcherInterface
    {
        return $GLOBALS['event_dispatcher'];
    }
}

if (! function_exists('set_event_dispatcher')) {
    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @return void
     */
    function set_event_dispatcher(EventDispatcherInterface $eventDispatcher): void
    {
        $GLOBALS['event_dispatcher'] = $eventDispatcher;
    }
}

if (! function_exists('dispatch_event')) {
    /**
     * @param EventInterface $event
     * @return void
     */
    function dispatch_event(EventInterface $event): void
    {
        get_event_dispatcher()->notify($event);
    }
}
