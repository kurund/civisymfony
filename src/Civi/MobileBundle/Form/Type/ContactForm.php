<?php

namespace Civi\MobileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('contactID' , 'hidden')
            ->add('firstName' , 'text')
            ->add('lastName'  , 'text');

    }

    public function getName()
    {
        return 'contact';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
                     'data_class' => 'Civi\MobileBundle\Entity\Contact',
                     );
    }
}