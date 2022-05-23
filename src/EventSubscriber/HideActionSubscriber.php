<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;

class HideActionSubscriber implements EventSubscriberInterface {
  public function onBeforeCrudActionEvent(BeforeCrudActionEvent $event) {
    dd($event);
  }

  public static function getSubscribedEvents() {
    return [
      BeforeCrudActionEvent::class => 'onBeforeCrudActionEvent',
    ];
  }
}
