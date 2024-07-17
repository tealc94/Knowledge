<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Entity\Lessons;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailLessonController extends AbstractController
{
    #[Route('/detail/{cursus}/lesson/{lesson}', name: 'app_detail_lesson')]
    public function index(Cursus $cursus, Lessons $lesson): Response
    {
        $fileName = $lesson->getFichiers();
        
        $filePath = $this->getParameter('kernel.project_dir'). '/public/uploads/lessons/'. $fileName;
        
 
        if(!file_exists($filePath)){
            throw $this->createNotFoundException('Le fichier demandé n\'existe pas.');
        }

        $fileContent = file_get_contents($filePath);

        return $this->render('detail_lesson/index.html.twig', [
            'cursus' => $cursus,
            'lesson' => $lesson,
            'fileContent' =>$fileContent,
        ]);
    }
}
