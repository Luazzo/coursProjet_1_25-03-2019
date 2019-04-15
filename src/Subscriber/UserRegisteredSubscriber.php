<?php

namespace App\Subscriber;

use App\Event\UserRegisteredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserRegisteredSubscriber
 */
class UserRegisteredSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            "user.registered" => [
                ["onRegistrationSuccess", 0],
            ]
        ];
    }
    
    /*
    public static function getSubscribedEvents1()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }*/

    public function onRegistrationSuccess(UserRegisteredEvent $event)
    {
        $rolesArr = array('ROLE_USER');

        $event->getUser()->setRoles($rolesArr);
        
    }

}
