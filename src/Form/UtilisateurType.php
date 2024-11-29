<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Adresse',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => '1',
                    'Femme' => '2',
                ],
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Courriel',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('login', TextType::class, [
                'label' => 'Identifiant',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'required'   => true,
                'disabled' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
