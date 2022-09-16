<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,
            [   
                'label' => 'Email',
                'attr' =>[
                'placeholder' =>'Votre email'
                ]
            ])

            ->add('password',RepeatedType::class,
            [   
                'constraints' => new Length([
                    'min' => 4,
                    'max' => 30
                ]),
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe ne sont pas identiques',
                'required' => true,

                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' =>['placeholder' => 'Entrez votre mot de passe']
                ],

                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' =>['placeholder' => 'Confirmez votre mot de passe']
                ],
                'mapped' => false
            ])
            // PasswordType::class est une classe qui permet de matérialiser un champ de type password
            //)
            ->add('lastname',TextType::class,
            [   
                'label' => 'Nom',
                'attr' =>[
                'placeholder' =>'Votre nom'
                ]
            ])
            ->add('firstname',TextType::class,
            [   
                'label' => 'Prenom',
                'attr' =>[
                'placeholder' =>'Votre prenom'
                ]
            ])
            ->add('pseudo',TextType::class,
            [   
                'label' => 'Pseudo',
                'attr' =>[
                'placeholder' =>'Votre pseudo'
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'homme' => 'homme',
                    'femme' => 'femme',
                ],
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('adress',TextType::class,
            [   
                'label' => 'Adresse',
                'attr' =>[
                'placeholder' =>'Votre adresse'
                ]
            ])
            ->add('size',TextType::class,
            [   
                'label' => 'Taille',
                'attr' =>[
                'placeholder' =>'Votre taille'
                ]
            ])
            ->add('mainPicture',FileType::class,
            [   
                'label' => 'Image',
                'attr' =>[
                'placeholder' =>'Inserer une photo'
                ]
            ])
            ->add('levelOfStudies', ChoiceType::class, [
                'choices' => [
                    'Bac' => 'bac',
                    'Bac +2' => 'bac +2',
                ],
            ])
            ->add('languages', ChoiceType::class, [
                'choices' => [
                    'Francais' => 'francais',
                    'Anglais' => 'anglais',
                ],
            ])
            ->add('smoke', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'oui',
                    'Non' => 'non',
                ],
            ])
            ->add('nationality',TextType::class,
            [   
                'label' => 'Nationalité',
                'attr' =>[
                'placeholder' =>'Votre nationalité'
                ]
            ])
            ->add('personalityTraits',TextType::class,
            [   
                'label' => 'Personnalité',
                'attr' =>[
                'placeholder' =>'Votre personnalité'
                ]
            ])
            ->add('sport',TextType::class,
            [   
                'label' => 'Sport',
                'attr' =>[
                'placeholder' =>'Votre sport prefere'
                ]
            ])
            ->add('job',TextType::class,
            [   
                'label' => 'Profession',
                'attr' =>[
                'placeholder' =>'Votre profession'
                ]
            ])
            ->add("inscription" ,SubmitType::class,
            [   
                'label' => 'Inscription',
                'attr' =>[
                'class' => 'btn btn-dark m-2'
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
