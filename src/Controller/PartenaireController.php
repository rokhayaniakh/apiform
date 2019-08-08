<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Form\UserType;
use App\Form\PartenaireType;
use App\Form\CompteType;
use App\Entity\User;
use App\Entity\Partenaire;
use App\Entity\Compte;


class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire")
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
                        'statu' => 201,
                        'messag' => 'Le partenaire a été créé'
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
}
