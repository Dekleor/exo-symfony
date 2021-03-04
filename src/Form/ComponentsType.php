<?php

namespace App\Form;

use App\Entity\Components;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ComponentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Components::AVAILABLE_TYPES)
            ])
            ->add('brand')
            ->add('price')
            ->add('computers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Components::class,
        ]);
    }
}
