<?php

namespace App\Controller;

use App\Entity\Lessons;
use App\Entity\Purchase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CertificatLessonController extends AbstractController
{
    #[Route('/certificatLesson/{id}', name: 'app_certificat_lesson')]
    public function certificatLesson(int $id, EntityManagerInterface $em): Response
    {           
        $lesson = $em->getRepository(Lessons::class)->find($id);

        $purchases = $em->getRepository(Purchase::class)->findBy(['lesson' => $lesson]);

        foreach($purchases as $purchase){
            $purchase->setCursusValidate(true);
            $em->persist($purchase);
        }

        $em->flush();
        
        return $this->render('certificat/validate.html.twig', [
            'controller_name' => 'CertificatController',
        ]);
    }    
}
