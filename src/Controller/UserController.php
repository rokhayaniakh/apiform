<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partenaire;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Form\UserType;
use App\Form\DepotType;
use App\Repository\DepotRepository;
use App\Repository\UserRepository;
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


/**
 * @Route("/api")
 */
class UserController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/user", name="users",methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data = $request->request->all();
        $file = $request->files->all()['imageName'];
        $form->submit($data);
        if ($form->isSubmitted()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $partenaire = $this->getUser()->getIdpartenaire();
            $user->setIdpartenaire($partenaire);
            //var_dump($data['roles']);die();
            $a=$data['roles'];
            $user->setRoles(["ROLE_$a"]);
            $user->setImageFile($file);
            $user->setUpdatedAt(new \DateTime());
            $errors = $validator->validate($user);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Typ' => 'applicatio/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->flush();
            $data = [
                'stat' => 201,
                'messa' => 'L\'utilisateur a été créé'
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
     * @Route("/ajoutcaissier", name="ajoutc",methods={"POST"})
     */
    public function ajoutcaissier(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data = $request->request->all();
        $file = $request->files->all()['imageName'];
        $form->submit($data);
        if ($form->isSubmitted()) {
            $a=$data['roles'];
            $user->setRoles(["ROLE_$a"]);
            $user->setImageFile($file);
            $user->setUpdatedAt(new \DateTime());
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
                'stat' => 201,
                'mesage' => 'Le caissier a été créé'
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

    // public function login(Request $request)
    // {
    //     $user = $this->getUser();
    //     return $this->json([
    //         'username' => $user->getUsername(),
    //         'roles' => $user->getRoles(),
    //         'id' => $user->getId(),
    //         'status' => $user->getStatus()
    //     ]);
    // }

    /**
     * @Route("/login_check", name="login", methods={"POST"})
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function bloquer(Request $request, JWTEncoderInterface  $JWTEncoder)
    {
        $values = json_decode($request->getContent());
        $username   = $values->username;
        $password   = $values->password;
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy(['username' => $username]);
        if (!$user) {
            return $this->json([
                'msag' => 'Username incorrect'
            ]);
        }
        $isValid = $this->passwordEncoder
            ->isPasswordValid($user, $password);
        if (!$isValid) {
            return $this->json([
                'mesage' => 'Mot de passe incorect'
            ]);
        }
        if ($user->getStatus() == "bloquer") {
            return $this->json([
                'mesag' => 'ACCÈS REFUSÉ vous ne pouvez pas connecter !'
            ]);
        }
        $token = $JWTEncoder->encode([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
            // 'id' => $user->getId(),
            // 'status' => $user->getStatus(),
            // 'idcompte' => $user->getIdcompte(),
            'exp' => time() + 86400 // 1 day expiration
        ]);
        $JWTEncoder->decode( $token);
//var_dump($entityManager);die();
        return $this->json([
            'token' => $token
        ]);
    }

    /** 
     * @Route("/bloquer" , name="bloquer", methods={"POST"})
     */
    public function bloquerdebloquer(Request $request, UserRepository $userRepo, EntityManagerInterface $entityManager): Response
    {
        $values = json_decode($request->getContent());
        $user = $userRepo->findOneByUsername($values->username);
        if ($user->getStatus() == "debloquer") {
            $user->SetStatus("bloquer");
            $entityManager->flush();
            $data = [
                'statu' => 200,
                'messag' => 'utilisateur bloquer'
            ];
            return new JsonResponse($data);
        } else {
            $user->SetStatus("debloquer");
            $entityManager->flush();
            $data = [
                'status' => 200,
                'message' => 'utilisateur debloquer'
            ];
            return new JsonResponse($data);
        }
    }

    /**
     * @Route("/ajoutcompteuser",name="ajoutcompteuser",methods={"POST"})
     */

    public function ajoutcomptuser(Request $request, UserRepository $userRepo, EntityManagerInterface $entityManager)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        $user = $userRepo->findOneBy(['username' => $data]);
        if (!$user) {
            return $this->json([
                'mesag' => 'Username incorrect'
            ]);
        }
        $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numbcompte' => $data]);
        $user->SetIdcompte($rec);
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Affectation de compte réussie !'
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/listerUser" , name="listerUser" ,methods={"GET"})
     */
    public function ListerUser(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $user = $userRepository->findAll();
        $users = $serializer->serialize($user, 'json', ['groups' => ['users']]);
        return new Response($users, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    /**
     * @Route("/listerdepot" , name="listerdepot" ,methods={"GET"})
     */
    public function Historique(DepotRepository $depotRepository, SerializerInterface $serializer)
    {
        $depot = $depotRepository->findAll();
        $depots = $serializer->serialize($depot, 'json', ['groups' => ['depot']]);
        return new Response($depots, 200, [
            'Content-Types' => 'applicatio/json'
        ]);
    }

}
