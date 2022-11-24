<?php

namespace App\Company\Form;

use App\Company\Domain\Company;
use App\Company\Domain\LegalStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('siren', TextType::class)
            ->add('immatCity', TextType::class)
            ->add('immatDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('capital', NumberType::class)
            ->add('legalStatus', EntityType::class, [
                'class' => LegalStatus::class,
                'choice_label' => 'name',
            ])
            ->add('addresses', CollectionType::class, [
                'entry_type' => AddressType::class,
                'by_reference' => false,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}