<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\WorkRepository;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog", name="app_")
 */
class BlogController extends AbstractController
{
    
    public function list(BlogRepository $workRepository, $nmb, $vue): Response
    {
        return $this->render('blog/'.$vue.'.html.twig', [
            'blogs' => $workRepository->findBlogsNmb($nmb)
        ]);
    }
    

    /**
     * @Route("/{id}-{slug}", name="blog_show", methods={"GET"})
     */
    public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

}
