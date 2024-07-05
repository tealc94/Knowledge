<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Entity\Lessons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LessonsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LessonController extends AbstractController
{
    #[Route('/lesson/{id}', name: 'app_lesson_detail')]
    public function detail(Cursus $cursus): Response
    {
        $lessons = $cursus->getLessons();

        return $this->render('lesson/index.html.twig', [
            'cursus' => $cursus,
            'lessons' => $lessons,
        ]);
    }

    #[Route('/lesson/{cursus}/add-to-cart/{lesson}', name:"app_add_cart")]
    public function addCart(Cursus $cursus, Lessons $lesson, SessionInterface $session): Response
    {
        $cart = $session->get('cart',[]);
        $cart[$lesson->getId()] = [
            'lesson' => $lesson,
            'cursus' => $cursus,
        ];
        
        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    
}
