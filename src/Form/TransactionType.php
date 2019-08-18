<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Transaction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('agence')
            ->add('somme')
            // ->add('frais')
            ->add('nomcomplet')
            ->add('nomcompletben')
            ->add('tel')
            ->add('cni')
            ->add('tele')
            ->add('iduser')
            ->add('idtype', EntityType::class ,['class'=>Type::class,'choice_label' =>'idtype'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
