<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Image;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom', TextType::class,[
                'constraints'=>[
                    new Regex([
                        'pattern'=>'/^[A-Za-z]+$/',
                        'message'=>"tu sais tapper ton prenom ?"
                    ])
                ]
            ])
            ->add('dateDeNaissanse')
            ->add('Jobs')
            ->add('topho',FileType::class,[
                'mapped'=>false,
                'required'=>false,
                'constraints'=>[
                    new Image([
                        'maxSize' => '2000k'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
