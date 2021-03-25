<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Form\PostsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function inde(): Response {
        $em = $this-> getDoctrine() -> getManager();
        $posts = $em->getRepository(Biblioteca::class)->findAll();
        return $this->render('dashboard/index.html.twig',[
            'posts' => $posts, 
            
            
        ]);
    }
}
