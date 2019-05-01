<?php

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
