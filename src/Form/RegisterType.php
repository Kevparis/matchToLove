<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('language', LanguageType::class, [
                'label' => 'Langue :',
                'attr' => ['placeholder' => 'You could choose your language'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Entrez votre Email'],
                'required' => true
            ])
            ->add('password', RepeatedType::class, [
                'constraints' => new Length([
                    'min' => 4,
                    'max' => 25
                ]),
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne matchent pas',
                'required' => true,
                'first_options' => [
                    'label' => 'Votre mot de passe :',
                    'attr' => ['placeholder' => 'Veuillez entrer vote mot de passe ici']
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe :',
                    'attr' => ['placeholder' => 'Veuillez entrer à nouveau votre mot de passe ici']
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse complète :',
                'attr' => ['placeholder' => 'Adresse : Ex: 2 rue Nomderue 94200 Villejuif']
            ])

            // ->add('paymentOption')
            // ->add('optionPrice')
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'attr' => ['placeholder' => 'Veuillez entrer votre nom'],
                'required' => true
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'attr' => ['placeholder' => 'Veuillez entrer votre prénom'],
                'required' => true
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance :',
                'attr' => ['placeholder' => 'Respectez ce format Ex : 2001-12-31'],
                'required' => true
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Sexe :',
                'choices' => [
                    'Female' => 'F',
                    'Male' => 'M'
                ],
                'required' => true
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'N° de Portable :',
                'attr' => ['Entrez votre numéro de Téléphone portable'],
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays/ State :',
                'attr' => ['placeholder' => 'Votre pays/ Etat de résidence actuelle'],
                'required' => true
            ])
            ->add('erea', TextType::class, [
                'label' => 'Votre région/ Borough :',
                'attr' => ['placeholder' => 'Ex 1 : Ile-de-France,  Ex2 : Manhattan '],
                'required' => true
            ])

            // Brève description

            // Il faudra vérifier qu'on ne puisse y entrer aucun numéro de téléphone ou autre ndication de contact sinon contrôler cela ailleurs dans le code avant affichage. et paiement.

            ->add('profileDescription', TextareaType::class, [
                'label' => 'Parlez de vous :',
                'attr' => ['placeholder' => 'Donnez une brève description de vous-même en 500 mots maximum'],
            ])

            // Les photos de profil

            // La photo principale à télécharger, requise
            ->add('mainPicture', FileType::class, [
                'label' => 'Photo principale',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => true
            ])
            // Les autres photos à télécharger
            ->add('picture2', FileType::class,  [
                'label' => '2ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture3', FileType::class,  [
                'label' => '3ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture4', FileType::class,  [
                'label' => '4ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture5', FileType::class,  [
                'label' => '5ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture6', FileType::class,  [
                'label' => '6ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture7', FileType::class,  [
                'label' => '7ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])
            ->add('picture8', FileType::class,  [
                'label' => '8ème Photo',
                'attr' => ['placeholder' => 'Télchargez une photo conforme'],
                'required' => false
            ])

            // Bouton "Soumettre du formulaire
            ->add('Submit', SubmitType::class, [
                'label' => 'Envoyer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
