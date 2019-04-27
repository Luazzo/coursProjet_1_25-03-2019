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
    
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(WorkRepository $workRepository, $nmb): Response
    {
        return $this->render('work/index.html.twig', [
            'works' => $workRepository->findWorksNmb($nmb),
        ]);
    }

 
    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Work $work): Response
    {
        return $this->render('work/show.html.twig', [
            'work' => $work,
        ]);
    }


}
