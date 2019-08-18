<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PartenaireRepository;
use App\Entity\Partenaire;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/kya",name="kya")
     */
    public function contrat(PartenaireRepository $partenaireRepository)
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->render('testcontrat.html.twig', []);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("listepartenaire.pdf", [
            "Attachment" => false
        ]);
    }
}
