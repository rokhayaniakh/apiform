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
            // $user=getIdcompte();
            // var_dump($user);die();
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
    public function retrait(Request $request,  TransactionRepository $transRepo, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $trans = new Transaction();
        $form = $this->createForm(TransactionType::class, $trans);
        $form->handleRequest($request);
        $data = $request->request->all();
        $form->submit($data);

        if ($form->isSubmitted()) {
            $transRepo = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code' => $data]);
            // var_dump($transRepo);die();
            if (!$transRepo) {
                return $this->json([
                    'mesag' => 'Code incorrect'
                ]);
            }
            $transRepo->setDater(new \DateTime());
            $transRepo->setCni($data['cni']);
            $users = $this->getUser();
            $transRepo->setUserr($users);
            $rec = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numbcompte' => $data]);
            if ($rec->getSolde() > $trans->getSomme()) {
                $rec->setSolde($rec->getSolde() + $trans->getSomme());
                $errors = $validator->validate($trans);
                if (count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                // var_dump($data);die();

                return new Response('Retrait effectué avec succés!!');
            } else {
                return new Response('le solde de votre compte ne vous permet pas de faire le retrait');
            }
        }
    }
}
