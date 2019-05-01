<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route({"en":"/category","fr":"/categorie"},name="app_category_")
 */
class CategoryController extends AbstractController
{
	/**
	 * @Route("/", name="index", methods={"GET"})
	 * @param CategoryRepository $categoryRepository
	 * @return Response
	 */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
	
	/**
	 * @param CategoryRepository $categoryRepository
	 * @param $nmb
	 * @param $vue
	 * @return Response
	 */
	public function list(CategoryRepository $categoryRepository, $nmb, $vue): Response
    {
        return $this->render('category/'.$vue.'.html.twig', [
            'categories' => $categoryRepository->findCategoriesNmb($nmb)
        ]);
    }
	
	/**
	 * @Route("/{id}", name="show", methods={"GET"})
	 * @param Category $category
	 * @return Response
	 */
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

  }
