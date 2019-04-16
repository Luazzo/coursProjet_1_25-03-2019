<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
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
        $rolesArr = ['ROLE_CLIENT'];

        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
        $user->setRoles($rolesArr);
        
        //$event->getUser()->setRoles($rolesArr);
//        return $user;
    	/**/
    }
}