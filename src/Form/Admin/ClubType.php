<?php

namespace App\Form\Admin;

use App\Enum\ClubGenderDiversityPolicy;
use App\Enum\CountrySubdivision;
use App\Form\Extension\DatePicker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // General information
        $builder
            ->add('name', TextType::class, ['label' => 'Nom :'])
            ->add('alias', TextType::class, ['label' => 'Alias :', 'required' => false])
            ->add('genderDiversityPolicy', EnumType::class, [
                'label' => 'Politique de genre :',
                'class' => ClubGenderDiversityPolicy::class,
                'required' => false,
                'choice_value' => function (null|ClubGenderDiversityPolicy|string $enum): string {
                    if (is_string($enum)) {
                        return ClubGenderDiversityPolicy::tryFrom($enum) ? $enum : '';
                    }

                    return $enum ? $enum->value : '';
                },
                'choice_label' => function (null|ClubGenderDiversityPolicy|string $enum): string {
                    if (is_string($enum)) {
                        $e = ClubGenderDiversityPolicy::tryFrom($enum);
                        return $e ? $e->value : '';
                    }

                    return $enum ? $enum->value : '';
                }
            ])
        ;

        // Submit
        $builder
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }
}
