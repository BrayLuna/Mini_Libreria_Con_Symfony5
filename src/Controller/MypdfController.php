<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Repository\BibliotecaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Incluir los espacios de nombres requeridos por Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

class MypdfController extends AbstractController
{
    #[Route('/mypdf', name: 'mypdf')]
    public function index(BibliotecaRepository $bibliotecaRepository)
    {
        $dompdf = new Dompdf();
        // Recupere el HTML generado en nuestro archivo twig
        $html = $this->renderView('mypdf/index.html.twig', [
             'bibliotecas' => $bibliotecaRepository->findAll(),
            'title' => "Welcome to our PDF Test"
        ]);

        // Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderiza el HTML como PDF
        $dompdf->render();

        // Envíe el PDF generado al navegador (descarga forzada)
        $dompdf->stream("bacalibro.pdf", [
            "Attachment" => true
        ]);
    }
}
