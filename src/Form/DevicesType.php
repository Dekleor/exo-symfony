<?php

namespace App\Form;

use App\Entity\Devices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class DevicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Devices::AVAILABLE_TYPES)
            ])
            ->add('brand')
            ->add('price')
            ->add('computers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devices::class,
        ]);
    }
}
