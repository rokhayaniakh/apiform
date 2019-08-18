<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use \Symfony\Component\HttpFoundation\File\UploadedFile ;
use App\Entity\Compte;
use App\Entity\Partenaire;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ]
            )
            ->add('nomcomplet')
            ->add('mail')
            ->add('tel')
            ->add('adresse')
            ->add('status')
            ->add('imageFile' ,VichImageType::class)
            #->add('updatedAt')
            // ->add('idcompte', EntityType::class ,['class'=>Compte::class,'choice_label' =>'idcompte']
            //)
            // ->add('idpartenaire',EntityType::class ,['class'=>Partenaire::class,'choice_label' =>'idpartenaire'])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection'=>false
        ]);
    }
}
