<?php

namespace App\Form\Type;

use App\Entity\GroupC;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;


class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group_name', TextType::class,[
                'constraints' =>[
                    new NotNull([
                        'message' => 'Group name can not be empty'
                    ]),
                    new Length([
                        'min' => 4,
                        'max' => 50
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupC::class,
        ]);
    }

}