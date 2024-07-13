<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Entity\Lessons;
use App\Repository\ThemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ThemesRepository $themesRepository): Response
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
        $cursusId = $request->query->get('cursus');
        $lessonId = $request->query->get('lesson');
        
        $cursus = null;
        $lesson = null;

        if($cursusId){
            $cursus = $em->getRepository(Cursus::class)->find($cursusId);
        }
        if($lessonId){
            $lesson = $em->getRepository(Lessons::class)->find($lessonId);           
        }
        
        $items = $session->get('cart', []);  
            
        if($cursus && $lesson){            
            // Browse the items in the basket to find the corresponding course.
            $found = false;
            foreach ($items as &$item) {
                if ($item['cursus']->getId() === $cursus->getId()) {
                    // Add lesson to existing curriculum in basket
                    $item['lesson'] = $lesson;
                    $found = true;
                    break; // Exit the loop as soon as the element is found
                }
            }
        // If the curriculum is not already in the basket, add it with the lesson.
        if (!$found) {
            $items[] = ['cursus' => $cursus, 'lesson' => $lesson];
        }
        }elseif ($cursus) {
            $items[]= ['cursus' => $cursus, 'lesson' => null];  
        }

        $session->set('cart', $items);        
        return $this->render('cart/index.html.twig', [
            'items' => $items,
        ]);        
    }
    
    #[Route('/cart/remove/{id}', name: 'app_remove')]
    public function removeCart(int $id, SessionInterface $session): Response
    {
        $items = $session->get('cart', []);

        // Search for item in basket
        foreach ($items as $key => $item) {
            if ($item['cursus']->getId() === $id) {
                unset($items[$key]);
                break; // Exits loop as soon as element is found
            }
        }

        // Update session with new basket
        $session->set('cart', $items);

        return $this->redirectToRoute('app_cart');
    }
}
