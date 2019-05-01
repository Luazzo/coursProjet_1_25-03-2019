<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/blog", name="app_")
 */
class BlogController extends AbstractController
{
	/**
	 * $nmb == '*' => return ALL BLOGS
	 * $pagination == null => pas de pagination
	 * $vue == quelle template choisir
	 * @param BlogRepository $blogRepository
	 * @param $nmb
	 * @param $vue
	 * @return Response
	 */
    public function list(BlogRepository $blogRepository, $nmb, $vue): Response
    {
    	
        return $this->render('blog/'.$vue.'.html.twig', [
            'blogs' => $blogRepository->findBlogsNmb($nmb)
        ]);
    }
	
	
	/**
	 * @Route("/", name="blog_index", methods={"GET"})
	 * @param PaginatorInterface $paginator
	 * @param BlogRepository $blogRepository
	 * @param Request $request
	 * @return Response
	 */
    public function index(PaginatorInterface $paginator, BlogRepository $blogRepository,Request $request): Response
    {
        $query=$blogRepository->findAll();
    	  $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('blog/index.html.twig', [
            'blogs' => $pagination,
        ]);
    }
	
	/**
	 * @Route("/{id}-{slug}", name="blog_show", methods={"GET"})
	 * @param Blog $blog
	 * @return Response
	 */
    public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

}
