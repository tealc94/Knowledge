<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Entity\Purchase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CertificatController extends AbstractController
{
    #[Route('/certificatCursus/{id}', name: 'app_certificat')]
    public function certificat(int $id, EntityManagerInterface $em): Response
    {
        
        $cursus = $em->getRepository(Cursus::class)->find($id);
        
        $purchases = $em->getRepository(Purchase::class)->findBy(['cursus' => $cursus]);
        
        foreach($purchases as $purchase){
            $purchase->setCursusValidate(true);
            $em->persist($purchase);
        }

        $em->flush();
        
        return $this->render('certificat/certificat.html.twig', [
            'controller_name' => 'CertificatController',
        ]);
    }    
}
