<?php

namespace App\Controller;

use App\Entity\Compte;
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

class TransController extends AbstractController
{
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
            $tran->setIduser($user);
            $tran->setFrais($values);
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numbcompte' => $data]);
            if ($rec->getSolde() > $tran->getSomme()) {
                $rec->setSolde($rec->getSolde() - $tran->getSomme() + $envoi);

                $errors = $validator->validate($tran);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                // $typ = new Type();
                // $form = $this->createForm(TypetransType::class, $typ);
                // $form->handleRequest($request);
                // $data = $request->request->all();
                // $form->submit($data);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tran);
                $entityManager->flush();
                return new Response('Le transfert a été effectué avec succés. Voici le code : ' . $tran->getCode());
            } else {
                return new Response('Le solde de votre compte ne vous permet d effectuer une transaction');
            }
        }
    }
    /**
     * @Route("/retrait", name="retrait")
     */
    public function retrait(Request $request,EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $retrait = new Transaction();
        $form = $this->createForm(TransactionType::class, $retrait);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);
        if ($form->isSubmitted()) {
            $retrait->setDater(new \DateTime());
            $valeur = $form->get('somme')->getData();
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
            $retrait->setIduser($user);
            $retrait->setFrais($values);
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numbcompte' => $data]);
            if ($rec->getSolde() > $retrait->getSomme()) {
                $rec->setSolde($rec->getSolde() + $retrait->getSomme() + $envoi);
                $errors = $validator->validate($retrait);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($retrait);
                $entityManager->flush();
                return new Response('Retrait avec effectué avec succés');
            }
        }
    }
}
