<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Repository\ThemesRepository;
use App\Repository\CursusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ThemesRepository $themesRepository, CursusRepository $cursusRepository): Response
    {
        $themes = $themesRepository->ListThemes();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'themes' => $themes,
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function viewCart(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $id = $request->query->get('id');
        if ($id) {
            $cursusAdd = $em->getRepository(Cursus::class)->find($id);
            if(!$cursusAdd){
                throw $this->createNotFoundException("Le cursus n'existe pas");
            }

            $cursus = $session->get('cursus', []);
            $cursus[$id] = $cursusAdd;
            $session->set('cursus', $cursus);
        }

        $cursus = $session->get('cursus', []);
        return $this->render('cart/index.html.twig', [
            'cursus' => $cursus,
        ]);
    }

    #[Route('/cart/remove/{id}', name: 'app_remove')]
    public function removeCart(int $id, SessionInterface $session): Response
    {
        $cursus = $session->get('cursus', []);

        if(isset($cursus[$id])){
            unset($cursus[$id]);
            $session->set('cursus', $cursus);
        }
        return $this->redirectToRoute('app_cart');
    }
}
