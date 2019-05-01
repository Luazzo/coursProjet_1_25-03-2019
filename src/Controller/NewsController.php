<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class NewsController extends AbstractController
{
	
	/**
	 * @param NewsRepository $newsRepository
	 * @param $nmb
	 * @return Response
	 */
	public function listNews(NewsRepository $newsRepository, $nmb): Response
    {
        return $this->render('partials/_news.html.twig', [
            'news' => $newsRepository->findNewsNmb($nmb),
        ]);
    }
    

}
