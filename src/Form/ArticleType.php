<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Client;
use App\Entity\Article;
use App\Entity\Employe;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Intitulé',
                'required'   => true,
                'disabled' => false,
                'empty_data' => 'Sans Reference',
            ])

            ->add('adresse', TextareaType::class, [
                'label' => 'Adresse',
                'required'   => true,
                'disabled' => false,

            ])
            ->add('images', TextType::class, [
                'label' => 'Photo',
                'required'   => false,
                'disabled' => true,
                'empty_data' => 'https://img.leboncoin.fr/api/v1/lbcpb1/images/04/de/81/04de81467bcb4f5ec2379f7289bc752a63bcd9e0.jpg?rule=classified-1200x800-webp',
            ])

            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'F1' => '1',
                    'F2' => '2',
                    'F3' => '3',
                    'F4' => '4',
                    'F5' => '5',
                ],
            ])

            ->add('surface', IntegerType::class, [])
            ->add('prix', IntegerType::class, [])
            ->add('owner', TextType::class, [
                'label' => 'Gestionnaire'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'titre',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',
                'label' => "Proprio"
            ])
            ->add('agence', EntityType::class, [
                'class' => Agence::class,
                'choice_label' => 'numeroAgence',
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'id',
                'label' => "Gestionnaire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
