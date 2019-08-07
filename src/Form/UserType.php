<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Compte;
use App\Entity\Partenaire;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('nomcomplet')
            ->add('mail')
            ->add('tel')
            ->add('adresse')
            ->add('status')
            ->add('idcompte', EntityType::class ,['class'=>Compte::class,'choice_label' =>'idcompte']
            )
            ->add('idpartenaire',EntityType::class ,['class'=>Partenaire::class,'choice_label' =>'idpartenaire']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
