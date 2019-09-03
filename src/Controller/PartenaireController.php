<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\User;
use App\Entity\Compte;
use App\Form\UserType;
use App\Form\CompteType;
use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\UserRepository;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PartenaireController extends AbstractController
{

    /**
     * @Route("/partenaire" ,methods={"GET"})
     */
    public function index(PartenaireRepository $partenaireRepository)
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('partenaire/index.html.twig', [
            'partenaires' => $partenaireRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("contrat_de_prestation.pdf", [
            "Attachment" => false
        ]);
    }
    /**
     * @Route("/partenaire", name="partenaire",methods={"POST"})
     */
    public function ajoutp(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $random = random_int(100000, 999999);
        $par = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $par);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $errors = $validator->validate($par);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $comp = new Compte();
            $form = $this->createForm(CompteType::class, $comp);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            if ($form->isSubmitted()) {
                $comp->setIdpartenaire($par);
                $comp->setNumbcompte($random);
                $errors = $validator->validate($comp);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                $user = new User();
                $form = $this->createForm(UserType::class, $user);
                $form->handleRequest($request);
                $data = $request->request->all();
                $form->submit($data);
                if ($form->isSubmitted()) {
                    $user->setIdpartenaire($par);
                    $user->setIdcompte($comp);
                    $user->setRoles(["ROLE_ADMIN"]);
                    $user->setPassword(
                        $passwordEncoder->encodePassword(
                            $user,
                            $form->get('password')->getData()
                        )
                    );
                    $errors = $validator->validate($user);
                    if (count($errors)) {
                        $errors = $serializer->serialize($errors, 'json');
                        return new Response($errors, 500);
                    }
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($par);
                    $entityManager->persist($comp);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $data = [
                        'stat' => 201,
                        'messa' => 'Le partenaire a été créé'
                    ];
                    return new JsonResponse($data, 201);
                }
                $data = [
                    'stat' => 500,
                    'mess' => 'Erreur!!!'
                ];
                return new JsonResponse($data, 500);
            }
        }
    }
    /**
     * @Route("/ajoutcompte",name="ajoutcompte",methods={"POST"})
     */

    public function ajoutcompte(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $random = random_int(100000, 999999);
        $comp = new Compte();
        $form = $this->createForm(CompteType::class, $comp);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $comp->setNumbcompte($random);
            $errors = $validator->validate($comp);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500);
            }
            $entityManager->persist($comp);
            $entityManager->flush();
            $data = [
                'statu' => 201,
                'messag' => 'Le compte a été créé'
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'stat' => 500,
            'mess' => 'Erreur!!!'
        ];
        return new JsonResponse($data, 500);
    }
    /**
     * @Route("/listerp" , name="listp" ,methods={"GET"})
     */
    public function ListerUser(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
        $par = $partenaireRepository->findAll();
        $parte = $serializer->serialize($par, 'json', ['groups' => ['partenaires']]);
        return new Response($parte, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
