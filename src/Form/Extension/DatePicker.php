<?php

namespace App\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
// Preconfigured DateType for js-datepicker
// https://www.npmjs.com/package/js-datepicker
final class DatePicker
{
    public static function addDatePicker(FormBuilderInterface $builder, string $field, string $label): void
    {
        $builder->add($field, DateType::class, [
            'label' => $label,
            'input' => 'datetime_immutable',
            'widget' => 'single_text',
            'html5' => false,
            'attr' => ['class' => 'js-datepicker'],
            'format' => 'd/m/Y',
        ]);
    }
}
