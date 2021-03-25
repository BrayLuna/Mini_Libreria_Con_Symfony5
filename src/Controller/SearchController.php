<?php

namespace App\Controller;

use App\Form\BibliotecaType;
use App\Repository\BibliotecaRepository;
use Symfony\Bridge\Twig\Node\DumpNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder(null)
            ->setAction($this->generateUrl(route: 'handleSearch'))
            ->add('query', TextType::class)
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();

        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /*  
    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(Request $request)
    {
        dump($request->request->get(key: 'form')['query']);
        die;
    }
    */
    
    
    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(Request $request, BibliotecaRepository $bibliotecaRepository){
       $query= $request->request->get(key:'form')['query'];
       if ($query) {
           $posts=$bibliotecaRepository->findAllGreaterThanPrice($query);
       }
       dump($posts); die;
    }
     
    
}
