<?php

namespace App\Controller;

use App\Repository\ThemesRepository;
use App\Repository\CursusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ThemesRepository $themesRepository, CursusRepository $cursusRepository): Response
    {
        $themes = $themesRepository->ListThemes();
        //$cursus = $cursusRepository->ListCursus();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'themes' => $themes,
            //'cursus' => $cursus,
        ]);
    }
}
