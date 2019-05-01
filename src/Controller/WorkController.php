<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkType;
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
    
    public function slider(WorkRepository $workRepository, $nmb): Response
    {
        return $this->render('work/slider.html.twig', [
            'works' => $workRepository->findWorksNmb($nmb)
        ]);
    }
    
    public function list(WorkRepository $workRepository, $nmb, $vue): Response
    {
        return $this->render('work/'.$vue.'.html.twig', [
            'works' => $workRepository->findWorksNmb($nmb)
        ]);
    }

 
    /**
     * @Route("/{id}-{slug}", name="show", methods={"GET"})
     */
    public function show(Work $work): Response
    {
        return $this->render('work/show.html.twig', [
            'work' => $work
        ]);
    }
    /**
     * @Route("/more", name="more", methods={"POST"})
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
