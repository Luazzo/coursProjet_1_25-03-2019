<?php
// src/AppBundle/Controller/RegistrationController.php
	
	namespace App\Controller;
	
	use App\Event\UserRegisteredEvent;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use FOS\UserBundle\Controller\RegistrationController as BaseController;
	use FOS\UserBundle\Event\GetResponseUserEvent;
	use Symfony\Component\HttpFoundation\Request;
	use FOS\UserBundle\FOSUserEvents;
	use FOS\UserBundle\Event\FormEvent;
	use FOS\UserBundle\Form\Factory\FactoryInterface;
	use FOS\UserBundle\Model\UserManagerInterface;
	use Symfony\Component\EventDispatcher\EventDispatcherInterface;
	use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
	
	class RegistrationController extends BaseController
	{
		
		public function __construct($serviceContainer=null)
		{
			
			parent::__construct();
		}
		
		public function registerAction(Request $request)
		{
			/** @var $formFactory FactoryInterface */
	        $formFactory = $this->get('fos_user.registration.form.factory');
	        /** @var $userManager UserManagerInterface */
	        $userManager = $this->get('fos_user.user_manager');
	        /** @var $dispatcher EventDispatcherInterface */
	        $dispatcher = $this->get('event_dispatcher');
	        /** @var $dispatcher TokenStorageInterface */
	        $tokenStorage = $this->get('security.token_storage');
	        
	        
			$user = $userManager->createUser();
			$user->setEnabled(true);
			
			$event = new GetResponseUserEvent($user, $request);
			$dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
			
			if (null !== $event->getResponse()) {
				return $event->getResponse();
			}
			
			$form = $formFactory->createForm();
			$form->setData($user);
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted()) {
				if ($form->isValid()) {
					$eventRole = new UserRegisteredEvent($user);
					$dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $eventRole);
					
					$event = new FormEvent($form, $request);
					$dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
					
					
					$userManager->updateUser($user);
					
					/*****************************************************
					 * Add new functionality (e.g. log the registration) *
					 *****************************************************/
					$this->container->get('logger')->info(
						sprintf("New user registration: %s", $user)
					);
					
					if (null === $response = $event->getResponse()) {
						$url = $this->generateUrl('fos_user_registration_confirmed');
						$response = new RedirectResponse($url);
					}
					
					$dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
					
					
					return $response;
				}
				
				$event = new FormEvent($form, $request);
				$dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);
				
				if (null !== $response = $event->getResponse()) {
					return $response;
				}
			}
			
			return $this->render('@FOSUser/Registration/register.html.twig', array(
				'form' => $form->createView(),
			));
		}
	}
