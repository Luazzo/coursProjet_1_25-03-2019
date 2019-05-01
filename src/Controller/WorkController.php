<?php
	
	namespace App\Controller;
	
	use App\Entity\Work;
	use App\Repository\WorkRepository;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use JMS\Serializer\SerializerBuilder as SerializerBuilder;
	/**
	 * @Route({"en":"/work","fr":"/travail"},name="app_work_")
	 * @ORM\Entity
	 * @ORM\Table(name="work_controller")
	 */
	class WorkController extends AbstractController
	{
		
		/**
		 * @param WorkRepository $workRepository
		 * @param $nmb
		 * @return Response
		 */
		public function slider(WorkRepository $workRepository, $nmb): Response
		{
			return $this->render('work/slider.html.twig', [
				'works' => $workRepository->findWorksNmb($nmb)
			]);
		}
		
		/**
		 * @param WorkRepository $workRepository
		 * @param $nmb
		 * @param $vue
		 * @return Response
		 */
		public function list(WorkRepository $workRepository, $nmb, $vue): Response
		{
			//$offset = 0;
			return $this->render('work/'.$vue.'.html.twig', [
				'works' => $workRepository->findWorksNmb($nmb)
			]);
		}
		
		
		/**
		 * @Route("/{id}-{slug}", name="show", methods={"GET"})
		 * @param Work $work
		 * @return Response
		 */
		public function show(Work $work): Response
		{
			return $this->render('work/show.html.twig', [
				'work' => $work
			]);
		}
		
		/**
		 * @Route("/more", name="more", methods={"POST"})
		 * @param WorkRepository $workRepository
		 * @param Request $request
		 * @return Response
		 */
		public function moreWorks(WorkRepository $workRepository, Request $request): Response
		{
			$offset = $request->request->get('offsetNmb');
			$vue = $request->request->get('vue');
			$nmb = $request->request->get('nmb');
			
			//je retourne le nombre des works demandé
			$works = $workRepository->findWorksNmb($nmb,$offset);
			//je genere serializer pour preparer la Reponse
			$serializer = SerializerBuilder::create()->build();
			
			//si works existent je les mets dans la vue
			if(!empty($works)){
				
				$html = $this->render('work/'.$vue.'.html.twig', [
					'works' => $works
				]);
				
				$jsonObject = $serializer->serialize($html, 'json');
	
				// For instance, return a Response with encoded Json
				return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
				
				
			}else{
				//je retourne FALSE si $works == null
				$jsonObject = $serializer->serialize(false, 'json');
				// For instance, return a Response with encoded Json
				return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
			}
		}

	
	    /**
	     * @param \App\Repository\WorkRepository $workRepository
	     * @param \App\Entity\Work               $work
	     * @return \Symfony\Component\HttpFoundation\Response
	     */
	    public function similar(WorkRepository $workRepository,Work $work): Response
	    {
	        $tags=$work->getTags();
	        return $this->render('work/similarworks.html.twig', [
	            'works' => $workRepository->findByTags($tags),
	            'work'=>$work
	        ]);
	    }

	}