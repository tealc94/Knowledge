<?php

namespace App\Controller;

use App\Entity\Cursus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailCursusController extends AbstractController
{
    #[Route('/detail/{cursus}', name: 'app_detail_cursus')]
    public function index(Cursus $cursus): Response
    {
        $fileName = $cursus->getFichiers();
        
        $filePath = $this->getParameter('kernel.project_dir'). '/public/uploads/lessons/'. $fileName;
        
 
        if(!file_exists($filePath)){
            throw $this->createNotFoundException('Le fichier demandé n\'existe pas.');
        }

        $fileContent = file_get_contents($filePath);

        return $this->render('detail_cursus/index.html.twig', [
            'cursus' => $cursus,
            'fileContent' =>$fileContent,
        ]);
    }
}
