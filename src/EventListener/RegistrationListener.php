<?php

namespace App\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * Listener responsible for adding the default user role at registration
 */
class RegistrationListener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => [
            	['onRegistrationSuccess', 10]
            ]
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
    	// 'ROLE_USER' est reservé par FOSUser, alors le rôle ne va pas s'enregistrer dans la DB.
        $rolesArr = ['ROLE_CLIENT'];

        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
        $user->setRoles($rolesArr);
        
    }
}