<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\User;
use App\Entity\Tarifs;
use App\Entity\Type;
use App\Form\TransactionType;
use App\Entity\Transaction;
use App\Form\TypetransType;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class TransController extends AbstractController
{
    private $dateFrom;
    private $dateTo;
    public function __construct()
    {
        $this->dateFrom='dateFrom';
        $this->dateTo='dateTo';
    }
    
    /**
     * @Route("/trans", name="trans")
     */
    public function transaction(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $random = random_int(100000, 999999);
        $tran = new Transaction();
        $form = $this->createForm(TransactionType::class, $tran);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $tran->setDatetran(new \DateTime());
            $tran->setCode($random);
            $valeur = $form->get('somme')->getData();
            $tarif = $this->getDoctrine()->getRepository(Tarifs::class)->findAll();
            foreach ($tarif as $values) {
                $values->getBorneInferieur();
                $values->getBorneSuperieur();
                $values->getValeur();
                if ($valeur >= $values->getBorneInferieur() && $valeur <= $values->getBorneSuperieur()) {
                    $commision = $values->getValeur();
                    $envoi = ($commision * 10) / 100;
                    break;
                }
            }
            $user = $this->getUser();
            $us = $user->getIdcompte();
            $tran->setIduser($user);
            $tran->setFrais($values);
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id' => $us]);
            if ($rec->getSolde() > $tran->getSomme()) {
                $rec->setSolde($rec->getSolde() - $tran->getSomme() + $envoi);
                $errors = $validator->validate($tran);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tran);
                $entityManager->flush();
                return new Response('Bienvenu(e) chez RafTafService   ' . $tran->getNomcomplet() . ' vous a envoyez ' . $tran->getSomme() . 'fcfa ' . ' votre code est : ' . $tran->getCode());
            } else {
                return new Response('Le solde de votre compte ne vous permet d effectuer une transaction');
            }
        }
    }
    /**
     * @Route("/retrait", name="retrait")
     */
    public function retrait(Request $request,  TransactionRepository $transRepo, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $trans = new Transaction();
        $form = $this->createForm(TransactionType::class, $trans);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $transRepo = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code' => $data]);
            if (!$transRepo) {
                return $this->json([
                    'mesag' => 'Code incorrect'
                ]);
            }
            // else {
            //     $data = $serializer->serialize($transRepo, 'json');
            //     return new Response($data, 200, [
            //         'Content-Type' => 'application/json'
            //     ]);
            // }
            $transRepo->setStatus('retrait');
            $transRepo->setDater(new \DateTime());
            $transRepo->setCni($data['cni']);
            $valeur = $transRepo->getSomme();
            $tarif = $this->getDoctrine()->getRepository(Tarifs::class)->findAll();
            foreach ($tarif as $values) {
                $values->getBorneInferieur();
                $values->getBorneSuperieur();
                $values->getValeur();
                if ($valeur >= $values->getBorneInferieur() && $valeur <= $values->getBorneSuperieur()) {
                    $commision = $values->getValeur();
                    $envoi = ($commision * 20) / 100;
                    break;
                }
            }
            $user = $this->getUser();
            $id = $user->getId();
            $us = $this->getUser()->getIdcompte();
            $rec = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]);
            $transRepo->setUserr($rec);
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id' => $us]);
            if ($rec->getSolde() > $trans->getSomme()) {
                $rec->setSolde($rec->getSolde() + $transRepo->getSomme() + $envoi);
                $errors = $validator->validate($trans);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                return new Response('Retrait effectué avec succés!!');
                //}
            } else {
                return new Response('le solde de votre compte ne vous permet pas de faire le retrait', 500);
            }
        }
    }
    /**
     * @Route("/testretrait", name="testretrait")
     */
    public function testretrait(Request $request,  TransactionRepository $transRepo, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $trans = new Transaction();
        $form = $this->createForm(TransactionType::class, $trans);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $transRepo = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code' => $data]);
            if (!$transRepo) {
                return $this->json([
                    'mesag' => 'Code incorrect'
                ]);
            } else {
                $data = $serializer->serialize($transRepo, 'json');
                return new Response($data, 200, [
                    'Content-Type' => 'application/json'
                ]);
            }
        }
    }
    /**
     * @Route("/com", name="com")
     */
    public function commission(Request $request,  TransactionRepository $transRepo, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $trans = new Transaction();
        $form = $this->createForm(TransactionType::class, $trans);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $valeur = $form->get('somme')->getData();
            $tarif = $this->getDoctrine()->getRepository(Tarifs::class)->findAll();
            foreach ($tarif as $values) {
                $values->getBorneInferieur();
                $values->getBorneSuperieur();
                $values->getValeur();
                if ($valeur >= $values->getBorneInferieur() && $valeur <= $values->getBorneSuperieur()) {
                    $commision = $values->getValeur();
                    $envoi = ($commision * 10) / 100;
                    break;
                }
            }
        }
        return new Response($commision);
    }
    /**
     * @Route("/listrans", name="listrans")
     */
    public function listTransaction(TransactionRepository $transRepository, SerializerInterface $serializer)
    {
        $user = $this->getUser();
        $trans = $transRepository->findBy(['iduser' => $user]);
        $transa = $serializer->serialize($trans, 'json', ['groups' => ['users']]);
        return new Response($transa, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    /**  
     * @Route("/listerenvoi", name="listerenvoi" ,methods={"GET","POST"})
     */

    public function listenvoi(SerializerInterface $serializer,Request $request):Response
    {
        $values = json_decode($request->getContent());
        if (!$values) {
            $values = $request->request->all();
        }
        $debut = new \DateTime($values->dateFrom);
        $fin   =  new \DateTime($values->dateTo);
        $user=$this->getUser();
        $days = $this->getDoctrine()
        ->getRepository(Transaction::class)
        ->getDays($debut, $fin, $user);
        $values = $serializer->serialize($days, 'json', [
            'groups' => ['users']
        ]);
                return new Response (
            $values, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
