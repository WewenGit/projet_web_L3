<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CritiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu', TextareaType::class, [
                'label' => 'Contenu de la critique',
            ])
            ->add('note', NumberType::class, [
                'label' => 'Note de la critique',
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                ],
                'constraints' => [
                    new Range([
                        'min' => 0,
                        'max' => 5,
                        'notInRangeMessage' => 'La note doit être comprise entre 0 et 5.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Confirmer',
            ]);
    }
}