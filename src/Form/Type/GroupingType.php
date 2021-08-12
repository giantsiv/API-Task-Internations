<?php

namespace App\Form\Type;

use App\Entity\GroupC;
use App\Entity\GroupingC;
use App\Entity\UserC;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;


class GroupingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::Class, [
                'class' => UserC::class,
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('group', EntityType::Class, [
                'class' => GroupC::class,
                'constraints' => [
                    new NotNull(),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GroupingC::class,
        ]);
    }

}