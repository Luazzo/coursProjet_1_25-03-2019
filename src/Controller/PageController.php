<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page",name="app_page_")
 */
class PageController extends AbstractController
{


    /**
	 * @Route("/{id}-{slug}", name="show", methods={"GET"}, defaults={"id"=1,"slug"="accueil"})
	 * @param Page $page
	 * @return Response
	 */
	public function show(Page $page): Response
    {
    	if($page->getSlug() == "blog"){
    		$pageBlogs = $this->getDoctrine()
			            ->getRepository(Blog::class)
			            ->findAll();
    		
	        return $this->render('blog/index.html.twig', [
	            'page' => $page,
	        ]);
	    }else{
	        return $this->render('page/show.html.twig', [
	            'page' => $page,
	        ]);
	    }
    }
	
	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	//pour contourner un problem de URL :
	//si on passe {_local} et defaults: id:1 slug: 'accueil'
	//la page de symfony s'affiche
	//alors cette fonction est pour faire redirection vers page_show avec des parametres
	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function home()
    {
        return $this->redirectToRoute('app_page_show',['id'=>1,'slug'=>'accueil','_locale'=>'fr']);
    }
	
	/**
	 * @param $req
	 */
	public function header($req):Response
    {
    	return $this->render('partials/_header.html.twig',['req'=>$req,'pages'=>$this->getDoctrine()->getRepository(Page::class)->findAll()]);
    }
    
}
