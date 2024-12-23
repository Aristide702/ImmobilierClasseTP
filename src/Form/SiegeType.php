<?php

namespace App\Form;

use App\Entity\Directeur;
use App\Entity\Siege;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SiegeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capital', NumberType::class, [
                'label' => 'Capital',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('adresse', TextareaType::class, [
                'label' => 'Adresse',
                'required'   => true,
                'disabled' => false,
            ])
            ->add('directeur', EntityType::class, [
                'label' => 'Directeur',
                'required'   => true,
                'disabled' => false,
                'class' => Directeur::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Siege::class,
        ]);
    }
}
