<?php

namespace App\Controller;

use App\Entity\Lessons;
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
        
        $cursusData = [];
        foreach($purchases as $purchase){
            $cursus = $purchase->getCursus();

            if($cursus){
                if(!isset($cursusData[$cursus->getId()])){
                    $cursusData[$cursus->getId()] = [
                        'cursus' => $cursus,
                        'total_lessons' => 0,
                        'validated_lessons_count' => 0
                    ];
                }
                $cursusData[$cursus->getId()]['total_lessons'] = count($cursus->getLessons());

                if ($purchase->getLesson() && $purchase->getLesson()->getId() !== null && $purchase->isCursusValidate()) {
                    $cursusData[$cursus->getId()]['validated_lessons_count']++;
                }
            }  
        }

        return $this->render('list_certificat/index.html.twig', [
            'controller_name' => 'ListCertificatController',
            'purchases' => $purchases,
            'cursus_data' => $cursusData,
        ]);
    }
}
