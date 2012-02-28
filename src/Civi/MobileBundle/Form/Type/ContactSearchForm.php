<?php

namespace Civi\MobileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactSearchForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('name' , 'text');
    }

    public function getName()
    {
        return 'search';
    }
}
