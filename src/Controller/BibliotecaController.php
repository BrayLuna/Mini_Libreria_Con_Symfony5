<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Form\BibliotecaType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\BibliotecaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/biblioteca')] 
class BibliotecaController extends AbstractController
{ 
    #[Route('/', name: 'biblioteca_index', methods: ['GET'])]
    public function index(BibliotecaRepository $bibliotecaRepository): Response
    {
        return $this->render('biblioteca/index.html.twig', [
            'bibliotecas' => $bibliotecaRepository->findAll(),
        ]); 
    }

    #[Route('/pdf', name: 'pdf', methods: ['GET'])]
    public function imprimir(BibliotecaRepository $bibliotecaRepository): Response
    {
        return $this->render('biblioteca/imprimir.html.twig', [
            'bibliotecas' => $bibliotecaRepository->findAll(),
        ]); 
    }

    #[Route('/new', name: 'biblioteca_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $biblioteca = new Biblioteca();
        $form = $this->createForm(BibliotecaType::class, $biblioteca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($biblioteca);
            $entityManager->flush();

            return $this->redirectToRoute('biblioteca_index'); 
        }

        return $this->render('biblioteca/new.html.twig', [
            'biblioteca' => $biblioteca,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'biblioteca_show', methods: ['GET'])]
    public function show(Biblioteca $biblioteca): Response
    {
        return $this->render('biblioteca/show.html.twig', [
            'biblioteca' => $biblioteca,
        ]);
    }

    #[Route('/{id}/edit', name: 'biblioteca_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biblioteca $biblioteca): Response
    {
        $form = $this->createForm(BibliotecaType::class, $biblioteca);
        $form->handleRequest($request);
        
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
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('biblioteca_index');
        }

        return $this->render('biblioteca/edit.html.twig', [
            'biblioteca' => $biblioteca,
            'form' => $form->createView(),
        ]);
    }







    
    #[Route('/{id}', name: 'biblioteca_delete', methods: ['DELETE'])]
    public function delete(Request $request, Biblioteca $biblioteca): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biblioteca->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($biblioteca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('biblioteca_index');
    }
}
