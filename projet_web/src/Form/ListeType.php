<?php

namespace App\Form;

use App\Entity\Liste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomListe', null, [
                'label' => 'Nom : ',
            ])
            ->add('idLivre', null, [
                'label' => 'Ajouter un livre : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liste::class,
        ]);
    }
}
