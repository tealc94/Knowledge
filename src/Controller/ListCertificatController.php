<?php

namespace App\Controller;

use App\Entity\Purchase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListCertificatController extends AbstractController
{
    #[Route('/list/certificat', name: 'app_list_certificat')]
    public function List(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $purchases = $em->getRepository(Purchase::class)->findBy(['user' => $user]);

        return $this->render('list_certificat/index.html.twig', [
            'controller_name' => 'ListCertificatController',
            'purchases' => $purchases,
        ]);
    }
}
