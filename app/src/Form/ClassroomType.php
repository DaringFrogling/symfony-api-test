<?php

namespace App\Form;

use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', IntegerType::class,[
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('class_name', TextType::class,[
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 120
                    ])
                ]
            ])
            ->add('foundation_date', DateTimeType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('is_active', CheckboxType::class, [
                'label'    => 'Is this class active?',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
