<?php
	
	namespace App\Controller;
	
	use App\Entity\Work;
	use App\Form\WorkType;
	use App\Repository\WorkRepository;
	use Doctrine\ORM\Mapping as ORM;
	use phpDocumentor\Reflection\DocBlock\Serializer;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Serializer\Encoder\JsonEncoder;
	use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
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
	}

namespace App\Controller;

use App\Entity\Work;
use App\Repository\WorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route({"en":"/work","fr":"/travail"},name="app_work_")
 */
class WorkController extends AbstractController
{

    /**
     * @param \App\Repository\WorkRepository $workRepository
     * @param                                $nmb
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function slider(WorkRepository $workRepository, $nmb): Response
    {
        return $this->render('work/slider.html.twig', [
            'works' => $workRepository->findWorksNmb($nmb)
        ]);
    }

    /**
     * @param \App\Repository\WorkRepository $workRepository
     * @param                                $nmb
     * @param                                $vue
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(WorkRepository $workRepository, $nmb, $vue): Response
    {
        return $this->render('work/'.$vue.'.html.twig', [
            'works' => $workRepository->findWorksNmb($nmb)
        ]);
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


    /**
     * @Route("/{id}-{slug}", name="show", methods={"GET"})
     * @param \App\Entity\Work $work
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Work $work): Response
    {
        return $this->render('work/show.html.twig', [
            'work' => $work
        ]);
    }

    /**
     * @Route("/more", name="more", methods={"POST"})
     * @param \App\Repository\WorkRepository            $workRepository
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function moreWorks(WorkRepository $workRepository, Request $request): Response
    {
    	$offset = $request->request->get('offsetNmb');
    	$vue = $request->request->get('vue');
    	$nmb = $request->request->get('nmb');
    	
    	$works = $workRepository->findWorksNmb($nmb);
    	/*$html = $this->render('work/'.$vue.'.html.twig', [
            'works' => $works
        ]);
    	echo($offset);die();*/
    	/*return $this->render('work/'.$vue.'.html.twig', [
            'works' => $workRepository->findWorksNmbo($nmb, $offset)
        ]);dump($request); die();;
    	$vue = */
    	return $this -> json($nmb);
    
    }


}
