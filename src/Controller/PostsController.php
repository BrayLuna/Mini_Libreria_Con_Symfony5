<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Form\PostsType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/Registrar-Post', name: 'RegistrarPosts')]
    public function index(Request $request)
    {
        $post = new Biblioteca();
        $form = $this->createForm(PostsType::class,$post);
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $brochureFile = $form->get('portada')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = iconv('UTF-8', 'ASCII//TRANSLIT', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('portadas_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception("Error en el proceso");
                    
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setPortada($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute(route:'dashboard');
        }
        return $this->render('posts/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/Post/{id}', name: 'VerPost')]
    public function VerPost($id){

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Biblioteca::class)->find($id);
        return $this->render('posts/verPost.html.twig',['post'=> $post]);

    }
  //  #[Route('/mis-post', name: 'Misposts')]
    //public function MisPost()
    //{
      //  $em = $this->getDoctrine()-> getManager();
        //$user = $this->getUser();
        //$posts = $em -> getRepository(Biblioteca::class)->findBy(['user'=>$user]);
        //return $this->render('posts/MisPosts.html.twig',['posts'=> $posts]);

    
}

