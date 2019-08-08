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
use App\Form\DepotType;
use App\Entity\User;
use App\Entity\Compte;
use App\Entity\Depot;

/**
 * @Route("/api")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user",methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $user->setRoles($user->getRoles());
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $errors = $validator->validate($user);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->flush();
            $data = [
                'statu' => 201,
                'messag' => 'L\'utilisateur a été créé'
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
     * @Route("/ajoutcaissier", name="user",methods={"POST"})
     */
    public function ajoutcaissier(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $user->setRoles(["ROLE_CAISSIER"]);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $errors = $validator->validate($user);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $data = [
                'statu' => 201,
                'messag' => 'Le caissier a été créé'
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
     * @Route("/depot",name="depot",methods={"POST"})
     */
    public function Depot(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $depot->setDate(new \DateTime());
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numbcompte' => $data]);
            $rec->setSolde($rec->getSolde() + $depot->getMontant());
            $depot->setIdcompte($rec);
            $errors = $validator->validate($depot);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->flush();
            $data = [
                'stat' => 201,
                'messa' => 'Depot Réussie'
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'stat' => 500,
            'mess' => 'Erreur!!!!'
        ];
        return new JsonResponse($data, 500);
    }

    /**
     * @Route("/login_check", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
}
